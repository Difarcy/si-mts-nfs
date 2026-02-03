@extends('admin.layouts.admin')

@section('title', 'Tambah Prestasi')

@section('content')
    <div class="flex flex-col gap-3" data-page="achievement-create">
        {{-- Header --}}
        <x-admin.ui.page-header title="Tambah Prestasi" subtitle="Catat prestasi gemilang yang diraih siswa-siswi">
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
                    <x-admin.form.button type="submit" variant="add" form="achievement-form" class="sm:w-24">
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
            <form id="achievement-form" action="{{ route('admin.konten.prestasi-siswa.store') }}" method="POST" data-submit-confirm="Simpan prestasi ini?"
                enctype="multipart/form-data">
                @csrf
                <div class="p-4 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        {{-- Left Column: Main Content --}}
                        <div class="md:col-span-3 space-y-4">
                            {{-- Nama Lomba --}}
                            <x-admin.form.input name="competition_name" label="Nama Lomba"
                                placeholder="Nama ajang atau kompetisi..." required />

                            {{-- Nama Siswa --}}
                            <x-admin.form.input name="student_name" label="Nama Siswa"
                                placeholder="Nama lengkap siswa peraih prestasi..." required />

                            {{-- Deskripsi --}}
                            <x-admin.form.textarea name="content" label="Deskripsi"
                                placeholder="Tuliskan detail prestasi atau cerita di balik kemenangan..." rows="10"
                                required />

                            {{-- Foto Siswa --}}
                            <x-admin.form.upload-image label="Foto Siswa" name="student_photo"
                                height="h-[500px] sm:h-[800px] aspect-[3/4]" required />

                            {{-- Sertifikat --}}
                            <x-admin.form.upload-image label="Sertifikat" name="certificate"
                                height="h-[300px] sm:h-[500px] aspect-video" required />
                        </div>

                        {{-- Right Column: Settings --}}
                        <div class="md:col-span-1 space-y-4">
                            {{-- Status --}}
                            <x-admin.form.select-input name="status" label="Status" required>
                                <option value="publish">Publish</option>
                                <option value="draft">Draft</option>
                            </x-admin.form.select-input>

                            {{-- Penulis --}}
                            <x-admin.form.input name="author" label="Penulis" placeholder="Nama penulis..."
                                value="{{ $defaultAuthor }}" required />

                            {{-- Kelas --}}
                            <x-admin.form.input name="class" label="Kelas" placeholder="Masukan Kelas" required />

                            {{-- Tingkat --}}
                            <x-admin.form.select-input name="level" label="Tingkat" required>
                                <option value="">Pilih Tingkat</option>
                                <option value="Sekolah">Sekolah</option>
                                <option value="Kecamatan">Kecamatan</option>
                                <option value="Kabupaten/Kota">Kabupaten/Kota</option>
                                <option value="Provinsi">Provinsi</option>
                                <option value="Nasional">Nasional</option>
                                <option value="Internasional">Internasional</option>
                            </x-admin.form.select-input>

                            {{-- Jenis --}}
                            <x-admin.form.select-input name="type" label="Jenis" required>
                                <option value="">Pilih Jenis</option>
                                <option value="Akademik">Akademik</option>
                                <option value="Non-Akademik">Non-Akademik</option>
                            </x-admin.form.select-input>

                            {{-- Penyelenggara --}}
                            <x-admin.form.input name="organizer" label="Penyelenggara" placeholder="Nama Penyelenggara" />

                            <x-admin.form.select-input name="rank" label="Peringkat" required>
                                <option value="">Pilih Peringkat</option>
                                <option value="Juara 1">Juara 1</option>
                                <option value="Juara 2">Juara 2</option>
                                <option value="Juara 3">Juara 3</option>
                            </x-admin.form.select-input>

                            {{-- Tanggal --}}
                            <div x-data="{ 
                                                isManual: false,
                                                timer: null,
                                                fillCurrentDate() {
                                                    const now = new Date();
                                                    const year = now.getFullYear();
                                                    const month = String(now.getMonth() + 1).padStart(2, '0');
                                                    const day = String(now.getDate()).padStart(2, '0');

                                                    if (!this.isManual && this.$refs.dateInput) {
                                                        this.$refs.dateInput.value = `${year}-${month}-${day}`;
                                                        this.$refs.dateInput.dispatchEvent(new Event('input', { bubbles: true }));
                                                    }
                                                },
                                                startTimer() {
                                                    this.fillCurrentDate();
                                                    // Update setiap 1 menit (tidak perlu per detik untuk tanggal)
                                                    this.timer = setInterval(() => this.fillCurrentDate(), 60000);
                                                },
                                                stopTimer() {
                                                    if (this.timer) clearInterval(this.timer);
                                                }
                                            }" x-init="startTimer()">
                                <x-admin.form.input type="date" name="achievement_date" label="Tanggal" required
                                    x-ref="dateInput" @input="isManual = true" />
                            </div>

                            <div class="pt-2 border-t border-gray-100">
                                <x-admin.form.tags-input name="tags" label="Tags"
                                    placeholder="Ketik tag lalu tekan Enter..." class="!min-h-[200px]" />
                            </div>


                        </div>
                    </div>
                </div>
            </form>
        </x-admin.ui.card>
    </div>
@endsection
