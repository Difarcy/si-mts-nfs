@extends('admin.layouts.admin')

{{-- 
    Halaman Edit Berita
    
    Menampilkan form untuk mengubah berita yang sudah ada.
    Memiliki fitur yang sama dengan halaman create, ditambah:
    - Preview gambar yang sudah ada (existing images)
    - Fitur sortable untuk mengatur urutan gambar
--}}

@section('title', 'Ubah Berita')

@section('content')
    <div class="flex flex-col gap-3" data-page="news-edit">
        {{-- Header --}}
        <x-admin.ui.page-header title="Edit Berita" subtitle="Ubah konten berita yang sudah ada">
            <x-slot:actions>
                <div class="flex items-center gap-3">
                    <x-admin.form.button variant="secondary" href="{{ route('admin.konten.berita.index') }}">
                        <x-slot:icon>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </x-slot:icon>
                        Batal
                    </x-admin.form.button>
                    <x-admin.form.button type="submit" variant="primary" form="news-edit-form"
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
            <form id="news-edit-form" action="{{ route('admin.konten.berita.update', $berita->id) }}" method="POST" data-submit-confirm="Simpan perubahan berita ini?"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="p-4 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        {{-- Left Column: Main Content --}}
                        <div class="md:col-span-3 space-y-4">
                            {{-- Judul Berita --}}
                            <x-admin.form.input name="title" label="Judul" value="{{ old('title', $berita->judul) }}"
                                placeholder="Masukkan judul berita yang menarik..." required />

                            {{-- Upload Thumbnail --}}
                            <x-admin.form.upload-image label="Thumbnail" name="thumbnail" height="!h-[400px]"
                                :existing="$thumbnailUrl" :existingValue="$berita->thumbnail" required
                                :enforceRequired="false" />

                            {{-- Upload Gambar --}}
                            <x-admin.form.upload-image label="Gambar" name="image" multiple="true" height="!h-[400px]"
                                :existing="$imagePaths" helper-text="Maksimal 6 gambar sekaligus." max-files="6" />

                            {{-- Deskripsi/Konten Berita --}}
                            <x-admin.form.textarea name="content" label="Deskripsi"
                                placeholder="Tuliskan detail berita di sini..." rows="15"
                                required>{{ old('content', $berita->deskripsi) }}</x-admin.form.textarea>
                        </div>

                        {{-- Right Column: Settings --}}
                        <div class="md:col-span-1 space-y-4">
                            {{-- Status --}}
                            <x-admin.form.select-input name="status" label="Status" required>
                                <option value="publish" {{ old('status', $berita->status) === 'publish' ? 'selected' : '' }}>
                                    Publish</option>
                                <option value="draft" {{ old('status', $berita->status) === 'draft' ? 'selected' : '' }}>Draft
                                </option>
                                <option value="nonaktif" {{ old('status', $berita->status) === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            </x-admin.form.select-input>

                            {{-- Penulis --}}
                            <x-admin.form.input name="author" label="Penulis" placeholder="Nama penulis..."
                                value="{{ old('author', $berita->penulis) }}" required />

                            {{-- Highlight --}}
                            <div class="pt-2 border-t border-gray-100">
                                <x-admin.form.checkbox name="is_highlight" label="Jadikan Highlight" :checked="(bool) old('is_highlight', $berita->is_highlight)" />
                            </div>

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
