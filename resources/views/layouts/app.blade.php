<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" />

    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.3/dist/cdn.min.js" defer></script>

    @vite(['resources/sass/app.scss','resources/js/app.js'])

    @livewireStyles
</head>

<body class="@auth hold-transition sidebar-mini @endauth">
    <div id="app">
        @auth
        <div class="wrapper">
            <x-navbars.navs.auth></x-navbars.navs.auth>

            <x-navbars.sidebar></x-navbars.sidebar>

            <div class="content-wrapper">
                {{ $slot }}
            </div>

            <x-footers.auth></x-footers.auth>
        </div>
        @else
        <main class="d-flex w-100">
            {{ $slot }}
        </main>
        @endauth
    </div>

    @livewireScripts

</body>

</html>