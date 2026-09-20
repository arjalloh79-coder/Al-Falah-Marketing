@extends('admin.main')

@section('admin-content')

<div class="max-w-2xl mx-auto">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-800">My Profile</h1>
        <p class="text-gray-500 mt-2">Update your name, email, and password.</p>
    </div>

    @if (session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-600 p-4 rounded-lg mb-6">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white p-8 rounded-2xl shadow-sm border">

        <form action="{{ route('admin.profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-5">
                <label class="block mb-2 font-medium">Full Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border rounded-lg p-3" required>
            </div>

            <div class="mb-5">
                <label class="block mb-2 font-medium">Email Address</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border rounded-lg p-3" required>
            </div>

            <hr class="my-6">

            <p class="text-sm text-gray-500 mb-4">Leave the password fields blank to keep your current password.</p>

            <div class="mb-5">
                <label class="block mb-2 font-medium">New Password</label>
                <input type="password" name="password" class="w-full border rounded-lg p-3">
            </div>

            <div class="mb-6">
                <label class="block mb-2 font-medium">Confirm New Password</label>
                <input type="password" name="password_confirmation" class="w-full border rounded-lg p-3">
            </div>

            <button type="submit" class="bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                Save Changes
            </button>

        </form>

    </div>

</div>

@endsection
