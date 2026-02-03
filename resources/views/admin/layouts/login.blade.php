<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Login') | MTs Nurul Falaah Soreang</title>
    @vite(['resources/css/website.css', 'resources/js/auth.js'])
</head>

<body class="bg-gray-100 h-screen flex items-center justify-center font-sans p-4">

    <div class="bg-white p-6 sm:p-8 rounded-lg shadow-lg w-full max-w-sm">
        @yield('content')
    </div>

    <x-admin.ui.notifications />

</body>

</html>
