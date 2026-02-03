@extends('admin.layouts.admin')

@section('title', 'Tambah Video')

@section('content')
    <div class="flex flex-col gap-3" data-page="video-create">
        {{-- Header --}}
        <x-admin.ui.page-header title="Tambah Video" subtitle="Publikasikan video dokumentasi sekolah dari YouTube">
            <x-slot:actions>
                <div class="flex items-center gap-2 sm:gap-3">
                    <x-admin.form.button variant="secondary" href="{{ route('admin.media.video.index') }}"
                        class="sm:w-24 border border-black">
                        <x-slot:icon>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </x-slot:icon>
                        Batal
                    </x-admin.form.button>
                    <x-admin.form.button type="submit" variant="add" form="video-form" class="sm:w-24 border border-black">
                        <x-slot:icon>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                        </x-slot:icon>
                        Publish
                    </x-admin.form.button>
                </div>
            </x-slot:actions>
        </x-admin.ui.page-header>

        {{-- Form Area --}}
        <x-admin.ui.card>
            <form id="video-form" action="{{ route('admin.media.video.store') }}" method="POST" data-submit-confirm="Simpan video ini?">
                @csrf
                <div class="p-4 sm:p-6 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        {{-- Left Column: Detail Video --}}
                        <div class="md:col-span-3 space-y-4">
                            {{-- Judul --}}
                            <x-admin.form.input name="title" label="Judul" placeholder="Masukan judul video dokumentasi..."
                                value="{{ old('title') }}" required />

                            {{-- Link --}}
                            <x-admin.form.input name="youtube_url" label="Link"
                                placeholder="Masukan link YouTube"
                                value="{{ old('youtube_url') }}" required />

                            {{-- Deskripsi --}}
                            <x-admin.form.textarea name="description" label="Deskripsi"
                                placeholder="Tuliskan deskripsi singkat mengenai isi video ini..." rows="12">{{ old('description') }}</x-admin.form.textarea>
                        </div>

                        {{-- Right Column: Pengaturan --}}
                        <div class="md:col-span-1 space-y-4">
                            {{-- Status --}}
                            <x-admin.form.select-input name="status" label="Status" required>
                                <option value="publish" {{ old('status', 'publish') === 'publish' ? 'selected' : '' }}>Publish</option>
                                <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                            </x-admin.form.select-input>
                        </div>
                    </div>
                </div>
            </form>
        </x-admin.ui.card>
    </div>
@endsection
