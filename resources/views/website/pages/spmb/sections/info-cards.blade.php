<!-- Info Cards (Variation 1: Left-Heavy Bento with Inter Font) -->
<section class="mt-4 md:-mt-12 relative z-20 pb-12 font-inter">
    <div class="container mx-auto px-4 sm:px-4">
        <div class="flex justify-center">
            <div class="grid grid-cols-3 gap-1.5 md:gap-6 w-full max-w-[420px] md:max-w-6xl">
                <!-- Status Pendaftaran Widget -->
                @php
                    $status = $spmb?->status ?: 'closed';
                    $statusColor = ($status == 'open') ? 'green' : (($status == 'pending') ? 'yellow' : 'red');
                    $statusText = ($status == 'open') ? 'Dibuka' : (($status == 'pending') ? 'Belum Dibuka' : 'Ditutup');
                    $statusLabelColor = ($status == 'open') ? 'text-green-600' : (($status == 'pending') ? 'text-yellow-600' : 'text-red-600');
                @endphp

                <div
                    class="group bg-white rounded-xl md:rounded-2xl shadow-md border border-gray-100 p-2 md:p-6 flex flex-col md:flex-row items-center justify-center md:justify-start gap-1 md:gap-5 min-h-[80px] md:min-h-0 hover:bg-gradient-to-br @if($status == 'open') hover:from-green-600 hover:to-green-700 @elseif($status == 'pending') hover:from-yellow-500 hover:to-yellow-600 @else hover:from-red-600 hover:to-red-700 @endif hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div
                        class="w-7 h-7 md:w-16 md:h-16 shrink-0 rounded-lg md:rounded-2xl bg-{{ $statusColor }}-100 text-{{ $statusColor }}-600 group-hover:bg-white group-hover:text-{{ $statusColor }}-700 flex items-center justify-center group-hover:scale-105 transition-all duration-300">
                        @if ($status == 'open')
                            <svg class="w-4 h-4 md:w-9 md:h-9" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                            </svg>
                        @elseif ($status == 'pending')
                            <svg class="w-4 h-4 md:w-9 md:h-9" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z" />
                            </svg>
                        @else
                            <svg class="w-4 h-4 md:w-9 md:h-9" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2C6.47 2 2 6.47 2 12s4.47 10 10 10 10-4.47 10-10S17.53 2 12 2zm5 13.59L15.59 17 12 13.41 8.41 17 7 15.59 10.59 12 7 8.41 8.41 7 12 10.59 15.59 7 17 8.41 13.41 12 17 15.59z" />
                            </svg>
                        @endif
                    </div>
                    <div class="flex flex-col min-w-0 text-center md:text-left">
                        <p
                            class="text-[8px] md:text-sm font-black {{ $statusLabelColor }} uppercase tracking-wider mb-0 md:mb-2 group-hover:text-white transition-colors leading-none truncate">
                            Status</p>
                        <h3
                            class="text-[11px] md:text-2xl font-extrabold text-gray-800 leading-tight group-hover:text-white transition-all duration-300 truncate">
                            {{ $statusText }}
                        </h3>
                    </div>
                </div>

                <!-- Kuota Widget -->
                <div
                    class="group bg-white rounded-xl md:rounded-2xl shadow-md border border-gray-100 p-2 md:p-6 flex flex-col md:flex-row items-center justify-center md:justify-start gap-1 md:gap-5 min-h-[80px] md:min-h-0 hover:bg-gradient-to-br hover:from-purple-600 hover:to-purple-700 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div
                        class="w-7 h-7 md:w-16 md:h-16 shrink-0 rounded-lg md:rounded-2xl bg-purple-100 text-purple-600 group-hover:bg-white group-hover:text-purple-700 flex items-center justify-center group-hover:scale-105 transition-all duration-300">
                        <svg class="w-4 h-4 md:w-9 md:h-9" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z" />
                        </svg>
                    </div>
                    <div class="flex flex-col min-w-0 text-center md:text-left">
                        <p
                            class="text-[8px] md:text-sm font-black text-purple-600 uppercase tracking-wider mb-0 md:mb-2 group-hover:text-white transition-colors leading-none truncate">
                            Kuota</p>
                        <h3
                            class="text-[11px] md:text-2xl font-extrabold text-gray-800 leading-tight group-hover:text-white transition-all duration-300 truncate">
                            {{ $spmb && $spmb->kuota !== null ? number_format((int) $spmb->kuota, 0, ',', '.') . ' Siswa' : '-' }}
                        </h3>
                    </div>
                </div>

                <!-- Biaya Widget -->
                <div
                    class="group bg-white rounded-xl md:rounded-2xl shadow-md border border-gray-100 p-2 md:p-6 flex flex-col md:flex-row items-center justify-center md:justify-start gap-1 md:gap-5 min-h-[80px] md:min-h-0 hover:bg-gradient-to-br hover:from-pink-600 hover:to-pink-700 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div
                        class="w-7 h-7 md:w-16 md:h-16 shrink-0 rounded-lg md:rounded-2xl bg-pink-100 text-pink-600 group-hover:bg-white group-hover:text-pink-700 flex items-center justify-center group-hover:scale-105 transition-all duration-300">
                        <svg class="w-4 h-4 md:w-9 md:h-9" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M11.8 2.1L3 6.9v10.1l8.8 4.8L21 17V6.9l-9.2-4.8zM12 4.1l7 3.6-7 3.6-7-3.6 7-3.6zm-7 5.5l6 3.1v7.4l-6-3.3V9.6zm8 10.5v-7.4l6-3.1v7.2l-6 3.3z" />
                        </svg>
                    </div>
                    <div class="flex flex-col min-w-0 text-center md:text-left">
                        <p
                            class="text-[8px] md:text-sm font-black text-pink-600 uppercase tracking-wider mb-0 md:mb-2 group-hover:text-white transition-colors leading-none truncate">
                            Biaya</p>
                        <h3
                            class="text-[11px] md:text-2xl font-extrabold text-gray-800 leading-tight group-hover:text-white transition-all duration-300 truncate">
                            @php
                                $biaya = $spmb?->biaya;
                            @endphp
                            @if ($biaya === null || (int) $biaya === 0)
                                Gratis
                            @else
                                Rp. {{ number_format((int) $biaya, 0, ',', '.') }}
                            @endif
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
