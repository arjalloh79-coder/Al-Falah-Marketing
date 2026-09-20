<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserSignupMail;
use App\Models\Blog;
use App\Models\Portfolio;
use App\Models\Consultation;


class Admincontroller extends Controller
{
    public function index()
    {
        $stats = [
            'total_leads' => Contact::count() + Consultation::count(),
            'blog_posts' => Blog::count(),
            'active_projects' => Portfolio::count(),
            'new_contacts_week' => Contact::where('created_at', '>=', now()->subDays(7))->count(),
        ];

        $recentContacts = Contact::latest()->take(5)->get();

        return view('admin.index', compact('stats', 'recentContacts'));
    } 
    
    public function createUser()
    {
        return view('admin.users.create');
    }

public function storeUser(Request $request)
    {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8',
        'role' => 'required'
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role
    ]);

    // Send welcome email
    Mail::to($user->email)->send(new UserSignupMail($user));

    return redirect()
        ->route('admin.users')
        ->with('success', 'User created successfully and welcome email sent.');
    }
    
     public function users()
    {
        // Fetch users with pagination (10 per page)
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'User deleted successfully.');
    } // Ensure this matches your Contact Model name


public function profile()
{
    return view('admin.profile', ['user' => auth()->user()]);
}

public function updateProfile(Request $request)
{
    $user = auth()->user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|min:8|confirmed',
    ]);

    $user->name = $request->name;
    $user->email = $request->email;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    return back()->with('success', 'Profile updated successfully.');
}

public function editUser($id)
{
    $user = User::findOrFail($id);
    return view('admin.users.edit', compact('user'));
}

public function updateUser(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'role' => 'required',
    ]);

    $user->name = $request->name;
    $user->email = $request->email;
    $user->role = $request->role;

    if ($request->filled('password')) {
        $request->validate(['password' => 'min:8']);
        $user->password = Hash::make($request->password);
    }

    $user->save();

    return redirect()->route('admin.users')->with('success', 'User updated successfully.');
}

public function contacts()
{
    // Fetch latest enquiries with pagination (10 per page)
    $contacts = Contact::latest()->paginate(10);
    
    return view('admin.contacts.index', compact('contacts'));
}

public function destroyContact($id)
{
    $contact = Contact::findOrFail($id);
    $contact->delete();

    return redirect()->back()->with('success', 'Enquiry deleted successfully.');
}

    
}
