<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Kaon Ta! Davao: Carinderia & Eatery Guide')
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-50 text-gray-800">

    @include('partials.nav')

    <main class="mx-auto min-h-[70vh] max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        @include('partials.flash')

        @yield('content')
    </main>

    <footer class="mt-12 bg-gray-900 py-6 text-center text-sm text-gray-300">
        <p>
            &copy; {{ date('Y') }} Kaon Ta! Davao: Carinderia & Eatery Guide.
        </p>
        <p class="mt-1">
            Discover local food, support local eateries.
        </p>
    </footer>

</body>

</html>