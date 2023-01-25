<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
</head>

<body class="d-flex w-100 h-100">
    <div class=" w-100 m-auto p-1" style="max-width: 400px;">
        <div class="text-center">
            <a href="/">
                <x-application-logo style="width: 72px;height:57px" class="m-auto mb-2" />
            </a>
        </div>

        <div class="w-100 mt-6 p-3 py-4 mx-6 y-4 bg-white shadow overflow-hidden rounded-2">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
