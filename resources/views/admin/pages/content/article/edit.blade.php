@extends('admin.layouts.admin')

@section('title', 'Edit Artikel')

@section('content')
    <div class="flex flex-col gap-3" data-page="article-edit">
        {{-- Header --}}
        <x-admin.ui.page-header title="Edit Artikel" subtitle="Ubah konten artikel yang sudah ada">
            <x-slot:actions>
                <div class="flex items-center gap-3">
                    <x-admin.form.button variant="secondary" href="{{ route('admin.konten.artikel.index') }}">
                        <x-slot:icon>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </x-slot:icon>
                        Batal
                    </x-admin.form.button>
                    <x-admin.form.button type="submit" variant="primary" form="article-edit-form"
                        class="sm:w-24 opacity-50 pointer-events-none" disabled>
                        <x-slot:icon>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                        </x-slot:icon>
                        Simpan
                    </x-admin.form.button>
                </div>
            </x-slot:actions>
        </x-admin.ui.page-header>

        {{-- Form Area --}}
        <x-admin.ui.card>
            <form id="article-edit-form" action="{{ route('admin.konten.artikel.update', $artikel->id) }}" method="POST" data-submit-confirm="Simpan perubahan artikel ini?"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="p-4 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        {{-- Left Column: Main Content --}}
                        <div class="md:col-span-3 space-y-4">
                            {{-- Judul Artikel --}}
                            <x-admin.form.input name="title" label="Judul" value="{{ old('title', $artikel->judul) }}"
                                placeholder="Masukkan judul artikel yang menarik..." required />

                            {{-- Upload Thumbnail --}}
                            <x-admin.form.upload-image label="Thumbnail" name="thumbnail" height="!h-[400px]"
                                :existing="$thumbnailUrl" :existingValue="$artikel->thumbnail" required
                                :enforceRequired="false" />

                            {{-- Upload Gambar --}}
                            <x-admin.form.upload-image label="Gambar" name="image" multiple="true" height="!h-[400px]"
                                :existing="$imagePaths" helper-text="Maksimal 6 gambar sekaligus." max-files="6" />

                            {{-- Deskripsi/Konten Artikel --}}
                            <x-admin.form.textarea name="content" label="Deskripsi"
                                placeholder="Tuliskan detail artikel di sini..." rows="15"
                                required>{{ old('content', $artikel->deskripsi) }}</x-admin.form.textarea>
                        </div>

                        {{-- Right Column: Settings --}}
                        <div class="md:col-span-1 space-y-4">
                            {{-- Status --}}
                            <x-admin.form.select-input name="status" label="Status" required>
                                <option value="publish" {{ old('status', $artikel->status) === 'publish' ? 'selected' : '' }}>
                                    Publish</option>
                                <option value="draft" {{ old('status', $artikel->status) === 'draft' ? 'selected' : '' }}>
                                    Draft</option>
                                <option value="nonaktif" {{ old('status', $artikel->status) === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            </x-admin.form.select-input>

                            {{-- Penulis --}}
                            <x-admin.form.input name="author" label="Penulis" placeholder="Nama penulis..."
                                value="{{ old('author', $artikel->penulis) }}" required />

                            {{-- Tags --}}
                            <div class="pt-2 border-t border-gray-100">
                                <x-admin.form.tags-input name="tags" label="Tags" :tags="$tags"
                                    placeholder="Ketik tag lalu tekan Enter..." class="!min-h-[200px]" />
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </x-admin.ui.card>
    </div>
@endsection
