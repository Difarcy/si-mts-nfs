@extends('admin.layouts.admin')

@section('title', 'Tambah Agenda')

@section('content')
    <div class="flex flex-col gap-3" data-page="agenda-create">
        {{-- Header --}}
        <x-admin.ui.page-header title="Tambah Agenda" subtitle="Buat dan publikasikan agenda kegiatan sekolah terbaru">
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
                    <x-admin.form.button type="submit" variant="add" form="agenda-form" class="sm:w-24">
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
            <form id="agenda-form" action="{{ route('admin.konten.agenda.store') }}" method="POST" data-submit-confirm="Simpan agenda ini?"
                enctype="multipart/form-data">
                @csrf
                <div class="p-4 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        {{-- Left Column: Main Content --}}
                        <div class="md:col-span-3 space-y-4">
                            {{-- Judul Agenda --}}
                            <x-admin.form.input name="title" label="Judul" placeholder="Masukkan nama agenda kegiatan..."
                                required />

                            {{-- Deskripsi/Konten Agenda --}}
                            <x-admin.form.textarea name="content" label="Deskripsi"
                                placeholder="Tuliskan detail agenda kegiatan di sini..." rows="15" required />

                            {{-- Upload Gambar Utama --}}
                            <x-admin.form.upload-image label="Gambar" name="image" :multiple="true"
                                helper-text="Maksimal 6 gambar sekaligus." max-files="6" />

                            {{-- Lampiran File --}}
                            <x-admin.form.file-picker label="Lampiran" name="attachment"
                                placeholder="Pilih file (pdf/docx/dll)..." />
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

                            {{-- Lokasi --}}
                            <div class="pt-2 border-t border-gray-100">
                                <x-admin.form.input name="location" label="Lokasi" placeholder="Lokasi kegiatan..."
                                    required />
                            </div>

                            {{-- Penjadwalan Publikasi dengan AlpineJS --}}
                            <div x-data="{ 
                                                            isScheduled: false,
                                                            isManual: false,
                                                            timer: null,
                                                            fillCurrentDateTime() {
                                                                if (this.isManual) return;
                                                                const now = new Date();
                                                                const year = now.getFullYear();
                                                                const month = String(now.getMonth() + 1).padStart(2, '0');
                                                                const day = String(now.getDate()).padStart(2, '0');
                                                                const hours = String(now.getHours()).padStart(2, '0');
                                                                const minutes = String(now.getMinutes()).padStart(2, '0');

                                                                if (this.$refs.dateInput) {
                                                                    this.$refs.dateInput.value = `${year}-${month}-${day}`;
                                                                }
                                                                if (this.$refs.timeInput) {
                                                                    this.$refs.timeInput.value = `${hours}:${minutes}`;
                                                                }
                                                            },
                                                            startTimer() {
                                                                this.fillCurrentDateTime();
                                                                this.timer = setInterval(() => this.fillCurrentDateTime(), 1000);
                                                            },
                                                            stopTimer() {
                                                                if (this.timer) clearInterval(this.timer);
                                                            }
                                                        }" x-init="$watch('isScheduled', value => {
                                                            if (value) startTimer();
                                                            else { stopTimer(); isManual = false; }
                                                        })" class="space-y-3 pt-2 border-t border-gray-100"
                                data-hide-on-draft="true">
                                <x-admin.form.checkbox name="is_scheduled" label="Jadwalkan" x-model="isScheduled" />

                                <div x-show="isScheduled" x-transition class="space-y-3" style="display: none;">
                                    <x-admin.form.input type="date" name="published_date" label="Tanggal" required
                                        ::required="isScheduled" x-ref="dateInput" @input="isManual = true; stopTimer()" @focus="isManual = true; stopTimer()" />

                                    <x-admin.form.input type="time" name="published_time" label="Waktu" required
                                        ::required="isScheduled" x-ref="timeInput" @input="isManual = true; stopTimer()" @focus="isManual = true; stopTimer()" />

                                    <div x-show="!isManual"
                                        class="flex items-center gap-1.5 text-[10px] text-green-600 font-medium bg-green-50 px-2 py-1 rounded-md w-fit">
                                        <span class="relative flex h-2 w-2">
                                            <span
                                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                            <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                                        </span>
                                        Waktu berjalan real-time
                                    </div>
                                </div>
                            </div>

                            {{-- Waktu Pelaksanaan --}}
                            <div x-data="{ 
                                                            isManualStart: false,
                                                            timer: null,
                                                            fillCurrentDateTime() {
                                                                const now = new Date();
                                                                const year = now.getFullYear();
                                                                const month = String(now.getMonth() + 1).padStart(2, '0');
                                                                const day = String(now.getDate()).padStart(2, '0');
                                                                const hours = String(now.getHours()).padStart(2, '0');
                                                                const minutes = String(now.getMinutes()).padStart(2, '0');

                                                                // Start Date/Time (Realtime until edited)
                                                                if (!this.isManualStart) {
                                                                    if (this.$refs.startDateInput) {
                                                                        this.$refs.startDateInput.value = `${year}-${month}-${day}`;
                                                                    }
                                                                    if (this.$refs.startTimeInput) {
                                                                        this.$refs.startTimeInput.value = `${hours}:${minutes}`;
                                                                    }
                                                                }
                                                            },
                                                            startTimer() {
                                                                this.fillCurrentDateTime();
                                                                this.timer = setInterval(() => this.fillCurrentDateTime(), 1000);
                                                            },
                                                            stopTimer() {
                                                                if (this.timer) clearInterval(this.timer);
                                                            }
                                                        }" x-init="startTimer()"
                                class="pt-2 border-t border-gray-100 space-y-4">

                                <div class="grid grid-cols-1 gap-4">
                                    <x-admin.form.input type="date" name="start_date" label="Tanggal Mulai" required
                                        x-ref="startDateInput" @input="isManualStart = true; stopTimer()" @focus="isManualStart = true; stopTimer()" />

                                    <x-admin.form.input type="date" name="end_date" label="Tanggal Selesai" />
                                </div>

                                <div class="grid grid-cols-1 gap-4">
                                    <x-admin.form.input type="time" name="start_time" label="Waktu Mulai" required
                                        x-ref="startTimeInput" @input="isManualStart = true; stopTimer()" @focus="isManualStart = true; stopTimer()" />

                                    <x-admin.form.input type="time" name="end_time" label="Waktu Selesai" />
                                </div>
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
