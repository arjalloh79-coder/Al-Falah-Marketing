@extends('admin.main')

@section('admin-content')

<div class="max-w-3xl mx-auto">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-800">
            Create New User
        </h1>
        <p class="text-gray-500 mt-2">
            Add a new user account manually.
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

        <form action="{{ route('admin.users.store') }}" method="POST">

            @csrf

            <div class="mb-5">
                <label class="block mb-2 font-medium">
                    Full Name
                </label>

                <input
                    type="text"
                    name="name"
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
                    class="w-full border rounded-lg p-3"
                    required>
            </div>

            <div class="mb-5">
                <label class="block mb-2 font-medium">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    class="w-full border rounded-lg p-3"
                    required>
            </div>

            <div class="mb-6">
                <label class="block mb-2 font-medium">
                    Role
                </label>

                <select
                    name="role"
                    class="w-full border rounded-lg p-3">

                    <option value="user">User</option>
                    <option value="admin">Admin</option>

                </select>
            </div>

            <button
                type="submit"
                class="bg-primary text-white px-6 py-3 rounded-lg font-bold">

                Create User

            </button>

        </form>

    </div>

</div>

@endsection