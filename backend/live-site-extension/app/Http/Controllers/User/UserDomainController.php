<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserDomainController extends Controller
{
    public function index()
    {
        // Get only the domains belonging to the logged-in user
        $domains = Auth::user()->domains()->orderBy('end_date', 'asc')->get();
        
        return view('User.domains.index', compact('domains'));
    }
}