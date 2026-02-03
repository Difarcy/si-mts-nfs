@extends('admin.layouts.admin')

@section('title', 'Edit Agenda')

@section('content')
    <div class="flex flex-col gap-3" data-page="agenda-edit">
        {{-- Header --}}
        <x-admin.ui.page-header title="Edit Agenda" subtitle="Ubah detail agenda kegiatan yang sudah ada">
            <x-slot:actions>
                <div class="flex items-center gap-3">
                    <x-admin.form.button variant="secondary" href="{{ route('admin.konten.agenda.index') }}">
                        <x-slot:icon>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </x-slot:icon>
                        Batal
                    </x-admin.form.button>
                    <x-admin.form.button type="submit" variant="primary" form="agenda-edit-form" class="sm:w-24">
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
            <form id="agenda-edit-form" action="{{ route('admin.konten.agenda.update', $agenda->id) }}" method="POST" data-submit-confirm="Simpan perubahan agenda ini?"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="p-4 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        {{-- Left Column: Main Content --}}
                        <div class="md:col-span-3 space-y-4">
                            {{-- Judul Agenda --}}
                            <x-admin.form.input name="title" label="Judul" value="{{ $agenda->judul }}"
                                placeholder="Masukkan nama agenda kegiatan..." required />

                            {{-- Deskripsi/Konten Agenda --}}
                            <x-admin.form.textarea name="content" label="Deskripsi"
                                placeholder="Tuliskan detail agenda kegiatan di sini..." rows="15"
                                required>{{ $agenda->deskripsi }}</x-admin.form.textarea>

                            {{-- Upload Gambar Utama --}}
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
                                <option value="publish" {{ $agenda->status === 'publish' ? 'selected' : '' }}>Publish</option>
                                <option value="draft" {{ $agenda->status === 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="nonaktif" {{ $agenda->status === 'nonaktif' ? 'selected' : '' }}>Nonaktif
                                </option>
                            </x-admin.form.select-input>

                            {{-- Penulis --}}
                            <x-admin.form.input name="author" label="Penulis" placeholder="Nama penulis..."
                                value="{{ $agenda->penulis ?? auth()->user()->nama }}" required />

                            {{-- Lokasi --}}
                            <div class="pt-2 border-t border-gray-100">
                                <x-admin.form.input name="location" label="Lokasi" value="{{ $agenda->lokasi }}"
                                    placeholder="Lokasi kegiatan..." required />
                            </div>

                            {{-- Waktu Pelaksanaan --}}
                            <div class="pt-2 border-t border-gray-100 space-y-4">
                                <div class="grid grid-cols-1 gap-4">
                                    <x-admin.form.input type="date" name="start_date" label="Tanggal Mulai"
                                        value="{{ $agenda->tanggal_mulai ? \Carbon\Carbon::parse($agenda->tanggal_mulai)->format('Y-m-d') : '' }}"
                                        required />
                                    <x-admin.form.input type="date" name="end_date" label="Tanggal Selesai"
                                        value="{{ $agenda->tanggal_selesai ? \Carbon\Carbon::parse($agenda->tanggal_selesai)->format('Y-m-d') : '' }}" />
                                </div>
                                <div class="grid grid-cols-1 gap-4">
                                    <x-admin.form.input type="time" name="start_time" label="Waktu Mulai"
                                        value="{{ $agenda->waktu_mulai ? \Carbon\Carbon::parse($agenda->waktu_mulai)->format('H:i') : '' }}"
                                        required />
                                    <x-admin.form.input type="time" name="end_time" label="Waktu Selesai"
                                        value="{{ ($agenda->waktu_selesai && $agenda->waktu_selesai !== '00:00:00') ? \Carbon\Carbon::parse($agenda->waktu_selesai)->format('H:i') : '' }}" />
                                </div>
                            </div>

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
