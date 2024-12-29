<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('components.head')
    </head>
    <body class="font-sans antialiased">
        <div class="">
            <!-- Include Navbar -->
            @include('components.navbar')

            <!-- Main Content -->
            <main class="bg-white dark:bg-slate-900 mx-12">
                @yield('content')
            </main>
        </div>

        <!-- Flowbite JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    </body>
</html>
