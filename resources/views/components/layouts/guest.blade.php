<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ECU Test Task') }}</title>

    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Styles -->
    <style>
        [x-cloak] {
            display: none;
        }
    </style>

    @livewireStyles

    <!-- Scripts -->
    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen flex flex-col text-gray-900 bg-gray-100 dark:bg-dark-eval-0 dark:text-gray-200">
        <x-general.header.header />

        <header>
            <div class="p-4 sm:p-6">
                {{ $header }}
            </div>
        </header>

        <main class="my-6 px-4 sm:px-6 flex-1">
            {{ $slot }}
        </main>

        <x-general.footer.footer />
    </div>
    @stack('scripts')
    @livewireScripts
</body>
</html>
