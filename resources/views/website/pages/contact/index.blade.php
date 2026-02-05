@extends('website.layouts.full')

@section('title', 'Kontak')

@section('content')
    <div class="space-y-6 pt-4 sm:pt-6" data-page="contact">
        <!-- Breadcrumb -->
        <x-website.components.layout.breadcrumb :items="[['label' => 'Kontak']]" />

        <!-- Header Section -->
        <x-website.components.layout.page-title title="Kontak" />

        <div class="w-full space-y-6">
            <!-- Contact Grid with Sidebar -->
            <div class="flex flex-col lg:flex-row gap-12">
                <!-- Kontak Information Sidebar -->
                <div class="flex flex-row gap-8 sm:gap-12 shrink-0">
                    <div class="space-y-8">
                        <!-- Contact Details -->
                        <div class="mb-6">
                            <h3
                                class="text-[13px] sm:text-[18px] font-bold text-black font-roboto-slab leading-tight inline-block border-b border-green-600 pb-1 mb-2">
                                Hubungi Kami</h3>
                            <ul class="space-y-5 font-inter">
                                <li class="flex items-center gap-3 group">
                                    <div
                                        class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-black flex items-center justify-center shrink-0">
                                        <svg class="w-full h-full scale-90" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                            <path d="M20.52 3.48A11.9 11.9 0 0 0 12.04 0C5.43 0 0 5.43 0 12.04c0 2.12.55 4.2 1.6 6.03L0 24l6.13-1.6a11.95 11.95 0 0 0 5.91 1.5h.01C18.67 23.9 24 18.57 24 11.96c0-3.2-1.24-6.2-3.48-8.48zM12.05 21.7h-.01a9.9 9.9 0 0 1-5.05-1.38l-.36-.21-3.64.95.97-3.55-.23-.37A9.9 9.9 0 1 1 12.05 21.7zm5.76-7.38c-.31-.15-1.82-.9-2.1-1-.28-.1-.48-.15-.68.15-.2.3-.78 1-.95 1.2-.17.2-.35.22-.66.07-.31-.15-1.3-.48-2.48-1.53-.92-.82-1.54-1.83-1.72-2.14-.18-.31-.02-.48.13-.63.14-.14.31-.35.46-.53.15-.18.2-.31.31-.51.1-.2.05-.38-.03-.53-.08-.15-.68-1.64-.93-2.25-.24-.58-.49-.5-.68-.51h-.58c-.2 0-.53.08-.8.38-.27.3-1.06 1.03-1.06 2.5 0 1.47 1.09 2.9 1.24 3.1.15.2 2.14 3.27 5.18 4.58.72.31 1.28.5 1.72.64.72.23 1.38.2 1.9.12.58-.09 1.82-.74 2.08-1.46.26-.72.26-1.34.18-1.46-.08-.12-.28-.2-.58-.35z"/>
                                        </svg>
                                    </div>
                                    <div class="flex flex-col">
                                        @if($kontak?->whatsapp)
                                            @php
                                                $waNumber = preg_replace('/[^0-9]/', '', $kontak->whatsapp);
                                                if (str_starts_with($waNumber, '0')) {
                                                    $waNumber = '62' . substr($waNumber, 1);
                                                }
                                            @endphp
                                            <a href="https://wa.me/{{ $waNumber }}" target="_blank" rel="noopener noreferrer"
                                                class="text-black hover:text-green-700 transition-colors text-xs sm:text-sm">{{ $kontak->whatsapp }}</a>
                                        @else
                                            <span class="text-black text-xs sm:text-sm">Belum ada</span>
                                        @endif
                                    </div>
                                </li>
                                <li class="flex items-center gap-3 group">
                                    <div
                                        class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-black flex items-center justify-center shrink-0">
                                        <svg class="w-full h-full" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </div>
                                    <div class="flex flex-col">
                                        @if($kontak?->telepon)
                                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $kontak->telepon) }}"
                                                class="text-black hover:text-blue-700 transition-colors text-xs sm:text-sm">{{ $kontak->telepon }}</a>
                                        @else
                                            <span class="text-black text-xs sm:text-sm">Belum ada</span>
                                        @endif
                                    </div>
                                </li>
                                <li class="flex items-center gap-3 group">
                                    <div
                                        class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-black flex items-center justify-center shrink-0">
                                        <svg class="w-full h-full" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div class="flex flex-col">
                                        @if($kontak?->email)
                                            <a href="mailto:{{ $kontak->email }}"
                                                class="text-black hover:text-red-700 transition-colors text-xs sm:text-sm">{{ $kontak->email }}</a>
                                        @else
                                            <span class="text-black text-xs sm:text-sm">Belum ada</span>
                                        @endif
                                    </div>
                                </li>
                                <li class="flex items-start gap-3 group">
                                    <div
                                        class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-black flex items-center justify-center shrink-0 mt-1">
                                        <svg class="w-full h-full" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <div class="flex flex-col">
                                        <p class="text-black leading-relaxed max-w-xs font-inter text-xs sm:text-sm whitespace-pre-line">
                                            {{ $kontak?->alamat ?: 'Belum ada' }}
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Vertical Social Media (Fixed Width) -->
                    <div class="flex flex-col gap-3 w-14 pt-0 mt-1 pl-1">
                        <!-- Facebook -->
                        @if(!empty($socialLinks['facebook']))
                            <a href="{{ $socialLinks['facebook'] }}" target="_blank" rel="noopener noreferrer"
                                class="group w-10 h-10 sm:w-12 sm:h-12 bg-white border border-gray-100 flex items-center justify-center transition-all duration-300 rounded-lg shadow-sm hover:bg-blue-600 hover:border-blue-600">
                        @else
                            <span class="w-10 h-10 sm:w-12 sm:h-12 bg-white border border-gray-100 flex items-center justify-center transition-all duration-300 rounded-lg shadow-sm cursor-default">
                        @endif
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-600 group-hover:text-white transition-colors duration-300"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        @if(!empty($socialLinks['facebook']))
                            </a>
                        @else
                            </span>
                        @endif
                        <!-- Instagram -->
                        @if(!empty($socialLinks['instagram']))
                            <a href="{{ $socialLinks['instagram'] }}" target="_blank" rel="noopener noreferrer"
                                class="group w-10 h-10 sm:w-12 sm:h-12 bg-white border border-gray-100 flex items-center justify-center transition-all duration-300 rounded-lg shadow-sm hover:bg-pink-600 hover:border-pink-600">
                        @else
                            <span class="w-10 h-10 sm:w-12 sm:h-12 bg-white border border-gray-100 flex items-center justify-center transition-all duration-300 rounded-lg shadow-sm cursor-default">
                        @endif
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-pink-600 group-hover:text-white transition-colors duration-300"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M7.5 2h9A5.5 5.5 0 0 1 22 7.5v9A5.5 5.5 0 0 1 16.5 22h-9A5.5 5.5 0 0 1 2 16.5v-9A5.5 5.5 0 0 1 7.5 2zM7.5 4A3.5 3.5 0 0 0 4 7.5v9A3.5 3.5 0 0 0 7.5 20h9A3.5 3.5 0 0 0 20 16.5v-9A3.5 3.5 0 0 0 16.5 4h-9z" />
                                <path d="M12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10zm0 2a3 3 0 1 0 0 6 3 3 0 0 0 0-6z" />
                                <path d="M17 6.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                            </svg>
                        @if(!empty($socialLinks['instagram']))
                            </a>
                        @else
                            </span>
                        @endif
                        <!-- X (Twitter) -->
                        @if(!empty($socialLinks['x']))
                            <a href="{{ $socialLinks['x'] }}" target="_blank" rel="noopener noreferrer"
                                class="group w-10 h-10 sm:w-12 sm:h-12 bg-white border border-gray-100 flex items-center justify-center transition-all duration-300 rounded-lg shadow-sm hover:bg-black hover:border-black">
                        @else
                            <span class="w-10 h-10 sm:w-12 sm:h-12 bg-white border border-gray-100 flex items-center justify-center transition-all duration-300 rounded-lg shadow-sm cursor-default">
                        @endif
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-gray-900 group-hover:text-white transition-colors duration-300"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                            </svg>
                        @if(!empty($socialLinks['x']))
                            </a>
                        @else
                            </span>
                        @endif
                        <!-- YouTube -->
                        @if(!empty($socialLinks['youtube']))
                            <a href="{{ $socialLinks['youtube'] }}" target="_blank" rel="noopener noreferrer"
                                class="group w-10 h-10 sm:w-12 sm:h-12 bg-white border border-gray-100 flex items-center justify-center transition-all duration-300 rounded-lg shadow-sm hover:bg-red-600 hover:border-red-600">
                        @else
                            <span class="w-10 h-10 sm:w-12 sm:h-12 bg-white border border-gray-100 flex items-center justify-center transition-all duration-300 rounded-lg shadow-sm cursor-default">
                        @endif
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-red-600 group-hover:text-white transition-colors duration-300"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                            </svg>
                        @if(!empty($socialLinks['youtube']))
                            </a>
                        @else
                            </span>
                        @endif
                        <!-- TikTok -->
                        @if(!empty($socialLinks['tiktok']))
                            <a href="{{ $socialLinks['tiktok'] }}" target="_blank" rel="noopener noreferrer"
                                class="group w-10 h-10 sm:w-12 sm:h-12 bg-white border border-gray-100 flex items-center justify-center transition-all duration-300 rounded-lg shadow-sm hover:bg-black hover:border-black">
                        @else
                            <span class="w-10 h-10 sm:w-12 sm:h-12 bg-white border border-gray-100 flex items-center justify-center transition-all duration-300 rounded-lg shadow-sm cursor-default">
                        @endif
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-black group-hover:text-white transition-colors duration-300"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z" />
                            </svg>
                        @if(!empty($socialLinks['tiktok']))
                            </a>
                        @else
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Contact Form Section -->
                <div class="flex-1">
                    <div class="space-y-0">
                        <h3
                            class="text-[13px] sm:text-[18px] font-bold text-black font-roboto-slab leading-tight inline-block border-b border-green-600 pb-1 mb-2">
                            Kirim Pesan
                        </h3>

                        @if(session('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                                <span class="block sm:inline">{{ session('success') }}</span>
                            </div>
                        @endif

                        <form id="contact-form" class="space-y-4" action="{{ route('web.contact.store') }}" method="POST">
                            @csrf
                            <x-website.components.form.input name="name" label="Nama Lengkap" placeholder="Masukan Nama"
                                required maxlength="35" />

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <x-website.components.form.input type="email" name="email" label="Email"
                                    placeholder="Masukan Email" required pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title="Harap sertakan '@' dalam alamat email" maxlength="30" />
                                <x-website.components.form.input type="tel" name="phone" label="Telepon/WA"
                                    placeholder="Masukan Telepon" required pattern="[0-9]{10,15}" title="Nomor telepon harus berupa angka, minimal 10 dan maksimal 15 digit" maxlength="15" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15)" />
                            </div>

                            <x-website.components.form.input name="subject" label="Subjek"
                                placeholder="Masukan Subjek Pesan" required />

                            <x-website.components.form.textarea name="message" label="Pesan"
                                placeholder="Tulis pesan atau pertanyaan Anda di sini..." rows="6" required />

                            <div class="flex justify-start">
                                <x-website.components.form.button type="submit">
                                    <span class="tracking-wider text-[10px] sm:text-sm uppercase">Kirim Pesan</span>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-3 w-3 sm:h-4 sm:w-4 transform group-hover:translate-x-1 transition-transform"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </x-website.components.form.button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Map Section -->
            <div class="border-t border-gray-100 pt-4">
                <x-website.components.layout.page-title title="Peta Lokasi" />

                <div class="mt-8">
                    <div class="w-full aspect-video md:aspect-[21/9] flex items-center justify-center text-center">
                        @if($kontak?->koordinat)
                            @php
                                $coord = trim((string) $kontak->koordinat);
                                $coordUrl = 'https://www.google.com/maps?q=' . urlencode($coord) . '&output=embed';
                            @endphp
                            <iframe class="w-full h-full" src="{{ $coordUrl }}" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        @else
                            <p class="text-xs sm:text-base font-semibold text-slate-900 tracking-wider">Belum Ada Lokasi</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
