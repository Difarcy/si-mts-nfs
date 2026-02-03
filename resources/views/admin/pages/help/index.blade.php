@extends('admin.layouts.admin')

@section('title', 'Bantuan')

@section('content')
    <div class="flex flex-col gap-3 max-w-6xl mx-auto pb-4">
        {{-- Page Header --}}
        <x-admin.ui.page-header title="Bantuan"
            subtitle="Panduan lengkap penggunaan dan pengelolaan website MTs Nurul Falaah">
            <x-slot:actions>
                <x-admin.form.button variant="secondary" href="{{ route('admin.dashboard') }}"
                    class="sm:w-24 border border-black">
                    <x-slot:icon>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </x-slot:icon>
                    Panel
                </x-admin.form.button>
            </x-slot:actions>
        </x-admin.ui.page-header>

        {{-- Section: Navigation --}}
        @include('admin.pages.help.sections.navigation')

        {{-- Section: Dashboard --}}
        @include('admin.pages.help.sections.dashboard')

        {{-- Section: Content Management --}}
        @include('admin.pages.help.sections.content')

        {{-- Section: Media --}}
        @include('admin.pages.help.sections.media')

        {{-- Section: Interaction --}}
        @include('admin.pages.help.sections.interaction')

        {{-- Section: Settings --}}
        @include('admin.pages.help.sections.settings')

        {{-- Section: Tips & Tricks --}}
        @include('admin.pages.help.sections.tips')

        {{-- Simple Footer --}}
        <div class="py-8 border-t border-black/10 text-center px-6">
            <h4 class="text-base font-bold text-black tracking-widest mb-2">MTs Nurul Falaah</h4>
            <p class="text-sm text-slate-900 max-w-2xl mx-auto leading-relaxed italic">
                Pusat dokumentasi ini diperbarui secara berkala untuk memastikan informasi pengelolaan sistem tetap relevan,
                akurat, dan profesional bagi seluruh administrator.
            </p>
        </div>
    </div>
@endsection