<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | MTs Nurul Falaah Soreang</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Roboto+Slab:wght@100..900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ $websiteLogo }}">

    @vite(['resources/css/website.css', 'resources/js/website.js'])
</head>

<body class="bg-gray-50 font-sans antialiased text-gray-800 flex flex-col min-h-screen">

    <!-- Topbar -->
    @include('website.components.layout.topbar')

    <!-- Header (Sticky) -->
    <div id="main-header-container" class="w-full sticky top-0 z-100 transition-shadow duration-300">
        @include('website.components.layout.header')
    </div>

    <!-- Hero Section -->
    @yield('hero')

    <!-- Main Container - Full Width -->
    <div class="flex-grow container mx-auto px-4 pb-8 sm:pb-12">
        <main class="w-full">
            @yield('content')
        </main>
    </div>

    <!-- Footer -->
    @include('website.components.layout.footer')

    <x-website.components.chatbot.chatbot />

    <x-website.components.ui.preview-image />
    <x-website.components.ui.notifications />

    @stack('scripts')
</body>

</html>
