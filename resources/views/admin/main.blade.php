<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Al-Falah</title>
    <!-- Tailwind & FontAwesome -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Alpine.js for Sidebar/Dropdowns -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        [x-cloak] { display: none !important; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800" x-data="{ sidebarOpen: false }">

    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar Include -->
        @include('admin.sidebar')

        <!-- Main Content Area -->
        <div class="flex flex-col flex-1 w-full overflow-y-auto overflow-x-hidden">
            
            <!-- Header Include -->
            @include('admin.header')

            <!-- Main Page Content -->
            <main class="p-4 md:p-8">
                @yield('admin-content')
            </main>

            <!-- Footer Include -->
            @include('admin.footer')
        </div>
    </div>

</body>
</html>