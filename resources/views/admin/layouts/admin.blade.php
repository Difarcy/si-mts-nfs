<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | MTs Nurul Falaah Soreang</title>

    <!-- Favicon Admin -->
    @php
        $logo = \App\Models\Logo::first();
        $faviconUrl = $logo && $logo->path 
            ? (str_starts_with($logo->path, 'images/') ? asset($logo->path) : asset('storage/' . $logo->path)) 
            : asset('favicon.ico');
    @endphp
    <link rel="icon" type="image/x-icon" href="{{ $faviconUrl }}">

    @if(request()->routeIs('admin.konten.berita.index') || request()->routeIs('admin.konten.artikel.index') || request()->routeIs('admin.konten.prestasi-siswa.index'))
        @php
            $adminViewKey = null;
            if (request()->routeIs('admin.konten.berita.index')) {
                $adminViewKey = 'admin_view_type:news';
            } elseif (request()->routeIs('admin.konten.artikel.index')) {
                $adminViewKey = 'admin_view_type:article';
            } elseif (request()->routeIs('admin.konten.prestasi-siswa.index')) {
                $adminViewKey = 'admin_view_type:achievements';
            }
        @endphp
        <script>
            document.documentElement.dataset.adminViewType = window.localStorage.getItem(@json($adminViewKey)) || window.localStorage.getItem('admin_view_type') || 'table';
        </script>
        <style>
            :root[data-admin-view-type="grid"] [data-admin-view-panel="table"] {
                display: none !important;
            }

            :root[data-admin-view-type="table"] [data-admin-view-panel="grid"] {
                display: none !important;
            }
        </style>
    @endif

    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
    @stack('styles')
</head>

<body class="font-sans bg-gray-100 text-slate-900">
    <div class="flex">
        @include('admin.components.layout.sidebar')
        <div class="flex-1 flex flex-col lg:ml-64">
            @include('admin.components.layout.header')
            <main class="flex-1 px-4 sm:px-6 py-4 relative">


                @yield('content')
            </main>
        </div>
    </div>
    {{-- Include additional JS modules --}}
    <x-admin.ui.preview-image />
    <x-admin.ui.unsaved-changes />
    <x-admin.ui.notifications />

    @if ($errors->any())
        <div data-admin-server-errors="1" hidden></div>
    @endif

    @stack('scripts')
</body>

</html>
