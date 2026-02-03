@extends('admin.layouts.admin')

@section('title', 'Edit Pengumuman')

@section('content')
    <div class="flex flex-col gap-3" data-page="announcement-edit">
        {{-- Header --}}
        <x-admin.ui.page-header title="Edit Pengumuman" subtitle="Ubah konten pengumuman yang sudah ada">
            <x-slot:actions>
                <div class="flex items-center gap-3">
                    <x-admin.form.button variant="secondary" href="{{ route('admin.konten.pengumuman.index') }}">
                        <x-slot:icon>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </x-slot:icon>
                        Batal
                    </x-admin.form.button>
                    <x-admin.form.button type="submit" variant="primary" form="announcement-edit-form" class="sm:w-24">
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
            <form id="announcement-edit-form" action="{{ route('admin.konten.pengumuman.update', $pengumuman->id) }}" data-submit-confirm="Simpan perubahan pengumuman ini?"
                method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="p-4 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        {{-- Left Column: Main Content --}}
                        <div class="md:col-span-3 space-y-4">
                            {{-- Judul Pengumuman --}}
                            <x-admin.form.input name="title" label="Judul" value="{{ $pengumuman->judul }}"
                                placeholder="Masukkan judul pengumuman..." required />

                            {{-- Deskripsi/Konten Pengumuman --}}
                            <x-admin.form.textarea name="content" label="Deskripsi"
                                placeholder="Tuliskan isi pengumuman secara lengkap di sini..." rows="15"
                                required>{{ $pengumuman->deskripsi }}</x-admin.form.textarea>

                            {{-- Upload Gambar (Multiple) --}}
                            <x-admin.form.upload-image label="Gambar" name="image" :multiple="true"
                               :existing="$imagePaths" helper-text="Maksimal 6 gambar sekaligus." max-files="6" />

                            {{-- Lampiran File --}}
                            <x-admin.form.file-picker label="Lampiran" name="attachment"
                                placeholder="Pilih file (pdf/docx/dll)..." :existing-url="$attachmentUrl"
                                :existing-name="$attachmentName" />
                        </div>

                        {{-- Right Column: Settings --}}
                        <div class="md:col-span-1 space-y-4">
                            {{-- Status --}}
                            <x-admin.form.select-input name="status" label="Status" required>
                                <option value="publish" {{ $pengumuman->status === 'publish' ? 'selected' : '' }}>Publish
                                </option>
                                <option value="draft" {{ $pengumuman->status === 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="nonaktif" {{ $pengumuman->status === 'nonaktif' ? 'selected' : '' }}>Nonaktif
                                </option>
                            </x-admin.form.select-input>

                            {{-- Penulis --}}
                            <x-admin.form.input name="author" label="Penulis" placeholder="Nama penulis..."
                                value="{{ $pengumuman->penulis ?? auth()->user()->nama }}" required />

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
