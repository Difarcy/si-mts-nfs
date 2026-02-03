@extends('admin.layouts.admin')

@section('title', 'Edit Prestasi')

@section('content')
    <div class="flex flex-col gap-3" data-page="achievement-edit">
        {{-- Header --}}
        <x-admin.ui.page-header title="Edit Prestasi" subtitle="Ubah detail prestasi siswa yang sudah tercatat">
            <x-slot:actions>
                <div class="flex items-center gap-3">
                    <x-admin.form.button variant="secondary" href="{{ route('admin.konten.prestasi-siswa.index') }}">
                        <x-slot:icon>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </x-slot:icon>
                        Batal
                    </x-admin.form.button>
                    <x-admin.form.button type="submit" variant="primary" form="achievement-edit-form" class="sm:w-24">
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
            <form id="achievement-edit-form" action="{{ route('admin.konten.prestasi-siswa.update', $prestasiSiswa->id) }}" data-submit-confirm="Simpan perubahan prestasi ini?"
                method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="p-4 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        {{-- Left Column: Main Content --}}
                        <div class="md:col-span-3 space-y-4">
                            {{-- Nama Lomba --}}
                            <x-admin.form.input name="competition_name" label="Nama Lomba"
                                value="{{ $prestasiSiswa->nama_lomba }}" placeholder="Nama ajang atau kompetisi..."
                                required />

                            {{-- Nama Siswa --}}
                            <x-admin.form.input name="student_name" label="Nama Siswa"
                                value="{{ $prestasiSiswa->nama_siswa }}" placeholder="Nama lengkap siswa peraih prestasi..."
                                required />

                            {{-- Deskripsi --}}
                            <x-admin.form.textarea name="content" label="Deskripsi"
                                placeholder="Tuliskan detail prestasi atau cerita di balik kemenangan..." rows="10"
                                required>{{ $prestasiSiswa->deskripsi }}</x-admin.form.textarea>

                            {{-- Foto Siswa --}}
                            <x-admin.form.upload-image label="Foto Siswa" name="student_photo" :existing="$studentPhotoUrl"
                                height="h-[500px] sm:h-[800px] aspect-[3/4]" />

                            {{-- Sertifikat --}}
                            <x-admin.form.upload-image label="Sertifikat" name="certificate" :existing="$certificateUrl"
                                height="h-[300px] sm:h-[500px] aspect-video" />
                        </div>

                        {{-- Right Column: Settings --}}
                        <div class="md:col-span-1 space-y-4">
                            {{-- Status --}}
                            <x-admin.form.select-input name="status" label="Status" required>
                                <option value="publish" {{ $prestasiSiswa->status === 'publish' ? 'selected' : '' }}>Publish
                                </option>
                                <option value="draft" {{ $prestasiSiswa->status === 'draft' ? 'selected' : '' }}>Draft
                                </option>
                                <option value="nonaktif" {{ $prestasiSiswa->status === 'nonaktif' ? 'selected' : '' }}>
                                    Nonaktif
                                </option>
                            </x-admin.form.select-input>

                            {{-- Penulis --}}
                            <x-admin.form.input name="author" label="Penulis" placeholder="Nama penulis..."
                                value="{{ $prestasiSiswa->penulis ?? auth()->user()->nama }}" required />

                            {{-- Kelas --}}
                            <x-admin.form.input name="class" label="Kelas" value="{{ $prestasiSiswa->kelas }}"
                                placeholder="Masukan Kelas" required />

                            {{-- Tingkat --}}
                            <x-admin.form.select-input name="level" label="Tingkat" required>
                                <option value="">Pilih Tingkat</option>
                                <option value="Sekolah" {{ $prestasiSiswa->tingkat === 'Sekolah' ? 'selected' : '' }}>Sekolah
                                </option>
                                <option value="Kecamatan" {{ $prestasiSiswa->tingkat === 'Kecamatan' ? 'selected' : '' }}>
                                    Kecamatan</option>
                                <option value="Kabupaten/Kota" {{ $prestasiSiswa->tingkat === 'Kabupaten/Kota' ? 'selected' : '' }}>Kabupaten/Kota</option>
                                <option value="Provinsi" {{ $prestasiSiswa->tingkat === 'Provinsi' ? 'selected' : '' }}>
                                    Provinsi</option>
                                <option value="Nasional" {{ $prestasiSiswa->tingkat === 'Nasional' ? 'selected' : '' }}>
                                    Nasional</option>
                                <option value="Internasional" {{ $prestasiSiswa->tingkat === 'Internasional' ? 'selected' : '' }}>Internasional</option>
                            </x-admin.form.select-input>

                            {{-- Jenis --}}
                            <x-admin.form.select-input name="type" label="Jenis" required>
                                <option value="">Pilih Jenis</option>
                                <option value="Akademik" {{ $prestasiSiswa->jenis === 'Akademik' ? 'selected' : '' }}>Akademik
                                </option>
                                <option value="Non-Akademik" {{ $prestasiSiswa->jenis === 'Non-Akademik' ? 'selected' : '' }}>
                                    Non-Akademik</option>
                            </x-admin.form.select-input>

                            {{-- Penyelenggara --}}
                            <x-admin.form.input name="organizer" label="Penyelenggara"
                                value="{{ $prestasiSiswa->penyelenggara }}" placeholder="Nama Penyelenggara" />

                            <x-admin.form.select-input name="rank" label="Peringkat" required>
                                <option value="">Pilih Peringkat</option>
                                <option value="Juara 1" {{ $prestasiSiswa->peringkat === 'Juara 1' ? 'selected' : '' }}>Juara
                                    1
                                </option>
                                <option value="Juara 2" {{ $prestasiSiswa->peringkat === 'Juara 2' ? 'selected' : '' }}>Juara
                                    2
                                </option>
                                <option value="Juara 3" {{ $prestasiSiswa->peringkat === 'Juara 3' ? 'selected' : '' }}>Juara
                                    3
                                </option>
                            </x-admin.form.select-input>

                            {{-- Tanggal --}}
                            <x-admin.form.input type="date" name="achievement_date" label="Tanggal"
                                value="{{ \Carbon\Carbon::parse($prestasiSiswa->tanggal)->format('Y-m-d') }}" required />

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
