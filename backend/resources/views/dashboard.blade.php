<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <a href="{{ route('admin.services.index') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-md transition">
                    <div class="text-sm text-gray-500">Manage</div>
                    <div class="text-xl font-semibold text-gray-900">Services</div>
                </a>
                <a href="{{ route('admin.orders.index') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-md transition">
                    <div class="text-sm text-gray-500">Manage</div>
                    <div class="text-xl font-semibold text-gray-900">Orders</div>
                </a>
                <a href="{{ route('admin.leads.index') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-md transition">
                    <div class="text-sm text-gray-500">Manage</div>
                    <div class="text-xl font-semibold text-gray-900">Leads</div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
