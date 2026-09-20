<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DomainDetail;
use App\Models\User;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    // Display list of domains and handle user retrieval for the dropdown
    public function index()
    {
        $domains = DomainDetail::with('user')->orderBy('end_date', 'asc')->get();
        $users = User::all(); // Populates select dropdown
        
        return view('admin.domain.index', compact('domains', 'users'));
    }

    // Save domain tracking entry to the database
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'domain_name' => 'required|string|max:255|unique:domain_details,domain_name',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        DomainDetail::create([
            'user_id' => $request->user_id,
            'domain_name' => $request->domain_name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->back()->with('success', 'Domain details registered successfully!');
    }

    // Delete a tracking entry
    public function destroy($id)
    {
        $domain = DomainDetail::findOrFail($id);
        $domain->delete();

        return redirect()->back()->with('success', 'Domain details removed successfully!');
    }
}