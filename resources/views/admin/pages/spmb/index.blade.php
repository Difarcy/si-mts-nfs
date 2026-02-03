@extends('admin.layouts.admin')

@section('title', 'SPMB/PPDB')

@section('content')
    <div class="flex flex-col gap-3 max-w-6xl mx-auto pb-4">
        <x-admin.ui.page-header title="SPMB/PPDB" subtitle="Pengelolaan konten halaman SPMB/PPDB">
            <x-slot:actions>
                <x-admin.form.button type="submit" variant="primary" form="spmb-form" class="cursor-not-allowed opacity-50" disabled>
                    Simpan
                </x-admin.form.button>
            </x-slot:actions>
        </x-admin.ui.page-header>

        @if($errors->any())
            <div class="px-4 py-3 border border-red-600/30 bg-red-50 text-red-800 text-sm">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <x-admin.ui.card bodyClass="p-4 sm:p-6">
            <form id="spmb-form" method="POST" action="{{ route('admin.spmb.update') }}" class="grid grid-cols-1 md:grid-cols-4 gap-6">
                @csrf
                @php
                    $waves = [1, 2];
                    $stages = [1, 2, 3, 4, 5];
                    $selectedStatus = old('status', $spmb?->status ?? 'closed');
                    $selectedYear = old('tahun', $spmb?->tahun ?? $defaultYear);
                @endphp

                <div class="md:col-span-3 space-y-5 order-1">
                    <div class="flex flex-col gap-2">
                        <h3 class="text-sm text-black">Status Pendaftaran</h3>
                        <fieldset class="flex flex-wrap items-center gap-x-6 gap-y-2">
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="radio" name="status" value="open" class="peer sr-only" @checked($selectedStatus === 'open') />
                                <span class="relative w-4 h-4 rounded-full border border-black after:content-[''] after:absolute after:inset-[2px] after:rounded-full after:bg-green-700 after:opacity-0 peer-checked:border-green-700 peer-checked:after:opacity-100"></span>
                                <span class="text-[12px] sm:text-sm text-black">Buka</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="radio" name="status" value="pending" class="peer sr-only" @checked($selectedStatus === 'pending') />
                                <span class="relative w-4 h-4 rounded-full border border-black after:content-[''] after:absolute after:inset-[2px] after:rounded-full after:bg-yellow-400 after:opacity-0 peer-checked:border-yellow-400 peer-checked:after:opacity-100"></span>
                                <span class="text-[12px] sm:text-sm text-black">Belum Dibuka</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="radio" name="status" value="closed" class="peer sr-only" @checked($selectedStatus === 'closed') />
                                <span class="relative w-4 h-4 rounded-full border border-black after:content-[''] after:absolute after:inset-[2px] after:rounded-full after:bg-red-600 after:opacity-0 peer-checked:border-red-600 peer-checked:after:opacity-100"></span>
                                <span class="text-[12px] sm:text-sm text-black">Ditutup</span>
                            </label>
                        </fieldset>
                    </div>
                </div>

                <div class="md:col-span-1 md:row-span-2 md:self-start space-y-4 order-2">
                    <x-admin.form.select-input name="tahun" label="Tahun Ajaran" required>
                        @foreach($years as $y)
                            @php $label = $y . '/' . ($y + 1); @endphp
                            <option value="{{ $label }}" @selected($label === $selectedYear)>{{ $label }}</option>
                        @endforeach
                    </x-admin.form.select-input>

                    <x-admin.form.input name="kuota" label="Kuota" type="number" :value="old('kuota', $spmb?->kuota)" placeholder="0" min="0" step="1" inputmode="numeric" />

                    <x-admin.form.input name="biaya" label="Biaya" type="number" :value="old('biaya', $spmb?->biaya)" placeholder="0" min="0" step="1" inputmode="numeric" />
                </div>

                <div class="md:col-span-3 space-y-5 order-3">
                    <div class="pt-2">
                        <h3 class="text-sm text-black">Jadwal Pendaftaran</h3>

                        <div class="space-y-4 mt-3">
                            @foreach($waves as $wave)
                                <div class="bg-gray-50/80 border border-black/10 p-3 sm:p-4 space-y-3">
                                    <p class="text-center text-[12px] sm:text-sm font-bold text-black">Gelombang {{ $wave }}</p>

                                    <div class="space-y-3">
                                        @foreach($stages as $stage)
                                            @php
                                                $nmKey = "g{$wave}t{$stage}nm";
                                                $stKey = "g{$wave}t{$stage}st";
                                                $enKey = "g{$wave}t{$stage}en";
                                            @endphp
                                            <div class="space-y-2">
                                                <div>
                                                    <x-admin.form.input
                                                        :name="$nmKey"
                                                        label="Tahap {{ $stage }}"
                                                        :value="old($nmKey, $spmb?->{$nmKey})"
                                                        placeholder="Nama tahap"
                                                        :asterisk="true" />
                                                </div>

                                                <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-x-4">
                                                    <div class="flex items-center gap-2">
                                                        <span class="text-[12px] sm:text-sm text-black whitespace-nowrap">Mulai</span>
                                                        <div class="w-full sm:w-[150px]">
                                                            <x-admin.form.input :name="$stKey" type="date" :value="old($stKey, $spmb?->{$stKey})" />
                                                        </div>
                                                    </div>
                                                    <div class="flex items-center gap-2">
                                                        <span class="text-[12px] sm:text-sm text-black whitespace-nowrap">Sampai</span>
                                                        <div class="w-full sm:w-[150px]">
                                                            <x-admin.form.input :name="$enKey" type="date" :value="old($enKey, $spmb?->{$enKey})" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </form>
        </x-admin.ui.card>
    </div>
@endsection
