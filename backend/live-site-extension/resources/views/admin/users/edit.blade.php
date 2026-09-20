@extends('admin.main')

@section('admin-content')

<div class="max-w-3xl mx-auto">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-800">
            Edit User
        </h1>
        <p class="text-gray-500 mt-2">
            Update {{ $user->name }}'s account details.
        </p>
    </div>

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

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="mb-5">
                <label class="block mb-2 font-medium">
                    Full Name
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $user->name) }}"
                    class="w-full border rounded-lg p-3"
                    required>
            </div>

            <div class="mb-5">
                <label class="block mb-2 font-medium">
                    Email Address
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email', $user->email) }}"
                    class="w-full border rounded-lg p-3"
                    required>
            </div>

            <div class="mb-5">
                <label class="block mb-2 font-medium">
                    New Password
                </label>

                <input
                    type="password"
                    name="password"
                    class="w-full border rounded-lg p-3"
                    placeholder="Leave blank to keep the current password">
            </div>

            <div class="mb-6">
                <label class="block mb-2 font-medium">
                    Role
                </label>

                <select
                    name="role"
                    class="w-full border rounded-lg p-3">

                    <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>

                </select>
            </div>

            <div class="flex items-center gap-3">
                <button
                    type="submit"
                    class="bg-primary text-white px-6 py-3 rounded-lg font-bold">

                    Save Changes

                </button>

                <a href="{{ route('admin.users') }}" class="text-gray-500 font-semibold px-6 py-3">
                    Cancel
                </a>
            </div>

        </form>

    </div>

</div>

@endsection
