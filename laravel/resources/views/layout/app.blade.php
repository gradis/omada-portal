<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"  class="h-full bg-gray-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Wi-Fi Access | @yield('title-block')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=alexandria:400,600,900&display=swap" rel="stylesheet" />
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    @vite('resources/css/app.css')

</head>
<body class="antialiased h-full">
<div class="min-h-full">
    <nav class="bg-gray-800">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <div>
                <a href="{{ route('dashboard') }}" class="text-white">Панелька</a>
                <a href="{{ route('user.add') }}" class="text-white ml-4">Добавить пользователя</a>
            </div>
            <div class="flex h-16 items-center justify-between">
                <div class="hidden md:block">
                    <div class="ml-4 flex items-center md:ml-6">
                        <!-- Profile dropdown -->
                        <div class="relative ml-3">
                            <div class="flex flex-row justify-center items-center">
                                <button type="button" class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                    <span class="absolute -inset-1.5"></span>
                                    <span class="sr-only">Open user menu</span>
                                </button>
                                <a href="{{ route('logout') }}" class="text-white pl-3">Выйти</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    @yield('content')
</div>
</body>
</html>
