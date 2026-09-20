<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Portfolio;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserSignupMail;


class UserController extends Controller
{
     public function index()

    {
        $projects = Portfolio::latest()->take(6)->get();
        // Fetch the 3 latest blog posts
        $blogs = Blog::latest()->take(3)->get();
        return view('User.index', compact('blogs', 'projects'));
    }

     public function about()
    {
        return view('User.about');
    }
     public function service()
    {
        return view('User.service');
    }
     public function blog(Request $request)
    {
    $category = $request->query('category');
    $search = $request->query('search');

    $featured = Blog::where('is_featured', true)->first();

    $blogs = Blog::where('is_featured', false)
        ->when($category, fn ($query) => $query->where('category', $category))
        ->when($search, fn ($query) => $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('content', 'like', "%{$search}%");
        }))
        ->latest()
        ->paginate(6)
        ->withQueryString();

    // Per-category counts for the filter bar, computed once from the
    // non-featured pool so "All Posts" and each tab's number stay in sync.
    $categoryCounts = Blog::where('is_featured', false)
        ->selectRaw('category, count(*) as total')
        ->groupBy('category')
        ->pluck('total', 'category');

    return view('User.blog', compact('blogs', 'featured', 'category', 'categoryCounts', 'search'));
    }



public function show($slug) {
    $blog = Blog::where('slug', $slug)->firstOrFail();
    return view('User.blog_single', compact('blog'));
}
     public function portfolio()
    {
        return view('User.portfolio');
    }

    public function login()
    {
        return view('User.login');
    }

    public function signup()
    {
        return view('User.signup');
    }

    // Process Form Login Data Input
    public function loginProcess(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // Intercept role types & dispatch to specific system dashboard routes
            if (Auth::user()->role === 'admin') {
                return redirect()->intended(route('admin.index'));
            }

            return redirect()->intended(route('user.dashboard'));
        }

        return back()->with('error', 'The provided credentials do not match our records.')->withInput();
    }

    // Process Form Signup Data Input
    public function signupProcess(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // Default value
        ]);

        // Send welcome email
        Mail::to($user->email)->send(new UserSignupMail($user));

        Auth::login($user);

        return redirect()->route('user.dashboard');
    }

    // Handle Authentication Termination
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

     public function web()
    {
        return view('User.services.web-development');
    }

     public function digital()
    {
        return view('User.services.digital-marketing');
    }

     public function branding()
    {
        return view('User.services.branding');
    }

    public function automation()
    {
        return view('User.services.automation');
    }

     public function content()
    {
        return view('User.services.content');
    }

     public function solution()
    {
        return view('User.services.solution');
    }

     public function privacy()
    {
        return view('User.privacy-policy');
    }

      public function terms()
    {
        return view('User.terms-conditions');
    }
}
