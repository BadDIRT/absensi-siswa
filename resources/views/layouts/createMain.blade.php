<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false }">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title') - ABSENSIKU</title>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.15.1/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen flex flex-col @include('layouts.components._bgColor') text-white">

<div class="flex flex-1">

    {{-- OVERLAY --}}
    @include('layouts.components._overlay')

    {{-- SIDEBAR --}}
    @include('layouts.components._sidebar')

    <div class="p-4 sm:p-6 w-full">

        {{-- LOGO --}}
        @include('layouts.components._logo')

        {{-- SIDEBAR MENU --}}
        @include('layouts.components._sidebarMenu')

        <div class="flex-1 flex flex-col transition-all duration-300">

            {{-- HEADER --}}
            @yield('header')

            {{-- MAIN CONTENT --}}
            <main class="p-2 sm:p-6 space-y-6 flex-1 mt-4">
                @yield('content')
            </main>

            {{-- FOOTER --}}
            @include('layouts.components._footer')

        </div>

    </div>
</div>

</body>
</html>
