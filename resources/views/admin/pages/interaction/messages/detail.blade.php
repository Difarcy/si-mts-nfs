@extends('admin.layouts.admin')

@section('title', 'Detail Pesan')

@section('content')
    <div class="flex flex-col gap-3">
        {{-- Header --}}
        <x-admin.ui.page-header title="Detail Pesan" subtitle="Membaca isi pesan lengkap dari pengunjung website">
            <x-slot:actions>
                <x-admin.form.button variant="secondary" href="{{ route('admin.interaksi.pesan-masuk.index') }}"
                    class="sm:w-24">
                    <x-slot:icon>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                    </x-slot:icon>
                    Kembali
                </x-admin.form.button>
            </x-slot:actions>
        </x-admin.ui.page-header>

        {{-- Main Card --}}
        <x-admin.ui.card>
            <x-slot:header>
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-gray-100 border border-black flex items-center justify-center text-sm sm:text-base font-bold">
                            {{ substr($message->nama, 0, 1) }}
                        </div>
                        <div>
                            <h3 class="text-sm sm:text-base font-bold text-black">{{ $message->nama }}</h3>
                            <p class="text-xs sm:text-sm text-black/60 font-normal">
                                {{ $message->email }} <span class="mx-1">•</span> {{ $message->telepon }}
                            </p>
                        </div>
                    </div>
                    <div class="text-left sm:text-right">
                        <p class="text-xs sm:text-sm font-normal text-black/60">{{ $message->tanggal->format('d F Y') }}</p>
                        <p class="text-xs sm:text-sm text-black/60 font-normal">Jam {{ $message->tanggal->format('H:i') }} WIB</p>
                    </div>
                </div>
            </x-slot:header>

            <div class="p-6 sm:p-8 bg-white min-h-[300px]">
                <div class="max-w-3xl">
                    <h4 class="text-sm sm:text-base font-bold text-black mb-4">{{ $message->subject }}</h4>
                    <div class="text-sm text-black leading-relaxed space-y-4">
                        {!! nl2br(e($message->pesan)) !!}
                    </div>
                </div>
            </div>

            <x-slot:footer>
                <div class="flex justify-end gap-3">
                    <form action="{{ route('admin.interaksi.pesan-masuk.destroy', $message->id) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?');">
                        @csrf
                        @method('DELETE')
                        <x-admin.form.button type="submit" variant="delete">
                            <x-slot:icon>
                                <x-admin.ui.icons.trash />
                            </x-slot:icon>
                            Hapus Pesan
                        </x-admin.form.button>
                    </form>

                    @php
                        // Email Logic
                        $replyTo = $message->email;
                        $replySubject = rawurlencode('Re: ' . ($message->subject ?? ''));
                        $replyBody = rawurlencode("Halo {$message->nama},\n\nTerima kasih sudah menghubungi kami.\n\n---\nPesan Anda:\n" . ($message->pesan ?? ''));
                        $gmailUrl = "https://mail.google.com/mail/?fs=1&tf=cm&to=" . rawurlencode($replyTo) . "&su={$replySubject}&body={$replyBody}";

                        // WhatsApp Logic
                        $phoneNumber = $message->telepon;
                        // Remove non-numeric characters
                        $cleanPhone = preg_replace('/[^0-9]/', '', $phoneNumber);
                        
                        // Default to original if processing fails, but try to fix 08xx -> 628xx
                        if (substr($cleanPhone, 0, 1) === '0') {
                             $cleanPhone = '62' . substr($cleanPhone, 1);
                        }
                        
                        $waUrl = "https://wa.me/{$cleanPhone}";
                    @endphp

                    <x-admin.form.button href="{{ $waUrl }}" variant="secondary" class="bg-green-50 text-green-700 hover:bg-green-100 border-green-200" target="_blank" rel="noopener">
                         <x-slot:icon>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                            </svg>
                         </x-slot:icon>
                         Balas via WhatsApp
                    </x-admin.form.button>

                    <x-admin.form.button href="{{ $gmailUrl }}" variant="primary" target="_blank" rel="noopener">
                        <x-slot:icon>
                            <x-admin.ui.icons.mail />
                        </x-slot:icon>
                        Balas via Email
                    </x-admin.form.button>
                </div>
            </x-slot:footer>
        </x-admin.ui.card>
    </div>
@endsection
