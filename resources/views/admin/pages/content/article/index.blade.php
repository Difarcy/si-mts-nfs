@extends('admin.layouts.admin')

@section('title', 'Artikel')

@section('content')
    <div class="flex flex-col gap-3" data-page="article-list">
        {{-- Header --}}
        <x-admin.ui.page-header title="Artikel" subtitle="Kelola artikel dan tulisan terbaru sekolah Anda">
            <x-slot:actions>
                @if($artikel->count() > 0)
                    <x-admin.form.button variant="add" href="{{ route('admin.konten.artikel.create') }}"
                        data-action="add-article" class="sm:w-24">
                        <x-slot:icon>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </x-slot:icon>
                        Tambah
                    </x-admin.form.button>
                @endif
            </x-slot:actions>
        </x-admin.ui.page-header>

        {{-- main content area --}}
        <x-admin.ui.card data-admin-list="true" data-admin-list-mode="server" x-data="{ 
                view: localStorage.getItem('admin_view_type:article') || localStorage.getItem('admin_view_type') || 'table' 
            }"
            x-init="$watch('view', value => { localStorage.setItem('admin_view_type:article', value); document.documentElement.dataset.adminViewType = value; })"
            bodyClass="p-3 sm:p-4">
            <x-slot:header>
                <div class="flex flex-wrap gap-1.5 sm:gap-2 items-center">
                    <x-admin.form.input-search placeholder="Cari artikel..." name="search" value="{{ request('search') }}"
                        :autocomplete="'off'" />

                    <div class="flex gap-1.5 sm:gap-2">
                        <x-admin.form.filter-sort name="status">
                            <option value="">Semua Status</option>
                            <option value="publish" {{ request('status') === 'publish' ? 'selected' : '' }}>Publish</option>
                            <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="nonaktif" {{ request('status') === 'nonaktif' ? 'selected' : '' }}>Nonaktif
                            </option>
                        </x-admin.form.filter-sort>

                        <x-admin.form.filter-sort name="sort">
                            <option value="latest" {{ request('sort', 'latest') === 'latest' ? 'selected' : '' }}>Terbaru
                            </option>
                            <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Terlama</option>
                            <option value="az" {{ request('sort') === 'az' ? 'selected' : '' }}>A-Z</option>
                            <option value="za" {{ request('sort') === 'za' ? 'selected' : '' }}>Z-A</option>
                        </x-admin.form.filter-sort>
                    </div>

                    <x-admin.ui.view-switcher activeView="view" />
                </div>
            </x-slot:header>

            <div id="article-list-container">
                @include('admin.partials.content.article.list', ['artikel' => $artikel])
            </div>

            <x-slot:footer>
                <div id="article-pagination-container">
                    @include('admin.partials.content.article.pagination', ['artikel' => $artikel])
                </div>
            </x-slot:footer>
        </x-admin.ui.card>
    </div>
@endsection