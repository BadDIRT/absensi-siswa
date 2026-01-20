<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false }">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('headerTitle')</title>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.15.1/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen flex flex-col @include('layouts.components._bgColor') text-white">

<div class="flex flex-1">

    @include('layouts.components._overlay')
    @include('layouts.components._sidebar')

    <div class="p-4 sm:p-6 w-full">

        @include('layouts.components._logo')
        @include('layouts.components._sidebarMenu2')

        <div class="flex-1 flex flex-col transition-all duration-300">

            <!-- HEADER -->
            <header class="sticky top-0 z-40 w-full bg-white/10 backdrop-blur-2xl border-b border-white/10 shadow-xl p-3 sm:p-4 flex flex-wrap gap-3 items-center justify-between rounded-2xl">
                <div class="flex items-center gap-3 w-full sm:w-auto justify-between">
                    <div class="flex items-center gap-3">
                        <button @click="sidebarOpen = !sidebarOpen" 
                            class="text-white text-2xl font-bold transform transition duration-300 hover:scale-125 hover:text-blue-300">☰
                        </button>

                        <img src="/images/absensiku-logo.png" class="hidden lg:block w-10 h-10 drop-shadow-xl">

                        <h1 class="text-xl sm:text-2xl font-bold drop-shadow">
                            @yield('pageTitle')
                        </h1>
                    </div>
                </div>

                <a href="@yield('routeCreate')"
                    class="px-4 py-2 bg-white/10 backdrop-blur-2xl hover:bg-white/20 border border-white/20 hover:scale-105 hover:shadow-lg text-white rounded-xl transition-all duration-300 font-semibold w-full sm:w-auto text-center">
                    @yield('createButtonText')
                </a>

            </header>

            @include('layouts.components._alertMessage')

            <!-- MAIN CONTENT -->
            <main class="p-2 sm:p-6 space-y-4 sm:space-y-8 flex-1 mt-4">

                <div class="bg-white/10 backdrop-blur-2xl border border-white/10 rounded-3xl shadow-2xl p-4 sm:p-6 overflow-x-auto">

                    <!-- FORM FILTER + SEARCH -->
                    <form method="GET" x-data="{ openFilter: false }"
                        class="mb-6 bg-white/10 backdrop-blur-2xl border border-white/20 rounded-2xl p-4 sm:p-5 shadow-xl space-y-4 transition">

                        @include('layouts.components._searchBar')
                        @include('layouts.components._filterToggleButton')

                        <div x-show="openFilter" x-transition.duration.400ms
                            class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5">

                            <!-- Filter Field -->
                            <div class="flex flex-col gap-1">
                                <label class="text-sm text-white/70">Filter Berdasarkan</label>
                                <select name="filter_field"
                                    class="px-4 py-3 rounded-xl bg-white/20 backdrop-blur-xl text-white border border-white/30 focus:ring-2 focus:ring-white/40 transition">
                                    <option value="" class="text-black">— Pilih Filter —</option>
                                    @yield('searching')
                                </select>
                            </div>

                            @include('layouts.components._filterValue')
                            @include('layouts.components._sorting')
                        </div>

                        @include('layouts.components._submitButton')
                    </form>

                    <h2 class="text-lg sm:text-xl font-bold mb-4 drop-shadow">
                        @yield('title')
                    </h2>

                    <!-- DESKTOP TABLE -->
                    <table class="w-full min-w-[900px] text-white text-xs sm:text-base hidden md:table">
                        <thead>
                            <tr class="bg-white/10 border-b border-white/20">
                                @yield('thead')
                            </tr>
                        </thead>

                        <tbody>
                            @yield('tableRowsData')
                        </tbody>
                    </table>

                    <!-- MOBILE CARDS -->
                    <div class="block md:hidden space-y-4 mt-4">
                        @yield('tableRowsDataMobile')
                    </div>

                </div>

                <!-- PAGINATION -->
                <div class="mt-6">
                    @yield('pagination')
                </div>

            </main>

            @include('layouts.components._footer')
        </div>
    </div>
</div>

</body>
</html>
