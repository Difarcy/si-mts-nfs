@extends('admin.layouts.admin')

@section('title', 'Pesan Masuk')

@section('content')
    <div class="flex flex-col gap-3" data-page="inbox-list">
        {{-- Header --}}
        <x-admin.ui.page-header title="Pesan Masuk" subtitle="Daftar pesan yang dikirim melalui halaman kontak website">
            <x-slot:actions>
                <div class="flex items-center gap-2 sm:gap-3"></div>
            </x-slot:actions>
        </x-admin.ui.page-header>

        {{-- Main Content Area --}}
        <x-admin.ui.card data-admin-list="true" data-admin-list-mode="server" bodyClass="p-0">
            <x-slot:header>
                <div class="flex flex-wrap gap-1.5 sm:gap-2 items-center">
                    <x-admin.form.input-search placeholder="Cari pesan..." name="search"
                        value="{{ request('search') }}" :autocomplete="'off'" />

                    <div class="flex gap-1.5 sm:gap-2">
                        <x-admin.form.filter-sort name="sort">
                            <option value="latest" {{ request('sort', 'latest') === 'latest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Terlama</option>
                            <option value="az" {{ request('sort') === 'az' ? 'selected' : '' }}>A-Z</option>
                            <option value="za" {{ request('sort') === 'za' ? 'selected' : '' }}>Z-A</option>
                        </x-admin.form.filter-sort>
                    </div>
                </div>
            </x-slot:header>

            <x-admin.interaction.list-toolbar :items="$messages" paginationId="inbox-pagination-container">
                <x-slot:dropdownItems>
                    <button type="button" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-50">Semua</button>
                    <button type="button" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-50">Tidak ada</button>
                    <button type="button" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-50">Dibaca</button>
                    <button type="button" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-50">Belum dibaca</button>
                </x-slot:dropdownItems>

                <x-slot:defaultActions>
                    <button class="toolbar-btn-default p-2 text-gray-600 hover:bg-gray-100 rounded-full transition-colors" title="Tandai Semua Dibaca" data-url="{{ route('admin.interaksi.pesan-masuk.mark-all-read') }}" data-method="PUT">
                        <x-admin.ui.icons.mail-open />
                    </button>
                </x-slot:defaultActions>

                <x-slot:bulkActions>
                    <button class="p-2 text-gray-600 hover:text-red-600 hover:bg-gray-100 rounded-full transition-colors" title="Hapus Terpilih">
                        <x-admin.ui.icons.trash />
                    </button>

                    <button id="bulk-toggle-status-btn" class="p-2 text-gray-600 hover:text-black hover:bg-gray-100 rounded-full transition-colors" title="Tandai Dibaca">
                        <x-admin.ui.icons.mail-open />
                    </button>
                </x-slot:bulkActions>
            </x-admin.interaction.list-toolbar>

            <div id="inbox-list-container">
            @if($messages->count() > 0)
                <div class="h-[500px] overflow-y-auto">
                    {{-- Gmail-style Inbox List (Div-based) --}}
                    <div class="flex flex-col border-t border-gray-200">
                        @foreach($messages as $message)
                            <div class="message-row group flex items-center px-3 sm:px-4 py-2 border-b border-gray-200 hover:shadow-[0_1px_3px_0_rgba(60,64,67,0.3),0_4px_8px_3px_rgba(60,64,67,0.15)] hover:z-10 relative transition-shadow cursor-pointer {{ $message->status === 'unread' ? 'bg-white font-bold' : 'bg-gray-50/50 font-normal' }}"
                                data-status="{{ $message->status }}"
                                onclick="if(!event.target.closest('.message-checkbox-container') && !event.target.closest('button') && !event.target.closest('input') && !event.target.closest('a')) window.location='{{ route('admin.interaksi.pesan-masuk.show', $message->id) }}'">
                                
                                {{-- Checkbox --}}
                                <div class="flex items-stretch h-8 flex-shrink-0 message-checkbox-container z-20 relative" onclick="event.stopPropagation()">
                                    <div class="px-2 rounded-sm hover:bg-gray-200 cursor-pointer flex items-center justify-center transition-colors" onclick="this.querySelector('input').click()">
                                        <div class="w-4 h-4 border-2 border-gray-500 rounded sm:w-4 sm:h-4 flex items-center justify-center bg-white relative pointer-events-none">
                                            <input type="checkbox" class="message-checkbox w-full h-full opacity-0 cursor-pointer absolute z-10 pointer-events-auto" value="{{ $message->id }}" onclick="event.stopPropagation()">
                                            <svg class="w-3 h-3 text-gray-600 hidden checked-icon pointer-events-none" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg>
                                        </div>
                                    </div>
                                </div>

                                {{-- Sender --}}
                                <div class="w-[7.5rem] sm:w-[9.5rem] md:w-[11.5rem] flex-shrink-0 font-roboto-slab truncate text-xs sm:text-sm {{ $message->status === 'unread' ? 'font-bold text-black' : 'text-black/70' }}">
                                    {{ $message->nama }}
                                </div>

                                {{-- Content --}}
                                <div class="flex-1 min-w-0 font-roboto-slab grid grid-cols-[auto_1fr] items-center gap-1">
                                    {{-- Subject --}}
                                    <span class="truncate text-xs sm:text-sm {{ $message->status === 'unread' ? 'font-bold text-black' : 'text-black/70' }}">
                                        {{ $message->subject }}
                                    </span>
                                    {{-- Message --}}
                                    <span class="text-xs sm:text-sm text-black font-normal truncate">
                                        - {{ $message->pesan }}
                                    </span>
                                </div>

                                {{-- Date / Hover Actions --}}
                                <div class="w-24 sm:w-32 flex-shrink-0 text-right px-2 flex items-center justify-end relative">
                                    {{-- Date Text (Default) --}}
                                    <span class="text-[10px] sm:text-xs whitespace-nowrap group-hover:hidden {{ $message->status === 'unread' ? 'text-black' : 'text-black/60 font-normal' }}">
                                        @if($message->tanggal->isToday())
                                            {{ $message->tanggal->format('H:i') }}
                                        @elseif($message->tanggal->isCurrentYear())
                                            {{ $message->tanggal->format('M d') }}
                                        @else
                                            {{ $message->tanggal->format('j/n/y') }}
                                        @endif
                                    </span>

                                    {{-- Hover Actions (Shown on Hover) --}}
                                    <div class="hidden group-hover:flex items-center justify-end gap-1 absolute right-2 top-1/2 -translate-y-1/2 pl-2">
                                        <form action="{{ route('admin.interaksi.pesan-masuk.destroy', $message->id) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-gray-500 hover:text-red-600 hover:bg-gray-100 rounded-full transition-colors" title="Hapus" onclick="event.stopPropagation()">
                                                <x-admin.ui.icons.trash />
                                            </button>
                                        </form>
                                        
                                        @if($message->status === 'read')
                                            <button type="button" 
                                                data-url="{{ route('admin.interaksi.pesan-masuk.mark-unread', $message->id) }}"
                                                data-method="PUT"
                                                class="action-btn-ajax p-2 text-gray-500 hover:text-black hover:bg-gray-100 rounded-full transition-colors" title="Tandai Belum Dibaca">
                                                <x-admin.ui.icons.mail />
                                            </button>
                                        @else
                                            <button type="button" 
                                                data-url="{{ route('admin.interaksi.pesan-masuk.mark-read', $message->id) }}"
                                                data-method="PUT"
                                                class="action-btn-ajax p-2 text-gray-500 hover:text-black hover:bg-gray-100 rounded-full transition-colors" title="Tandai Sudah Dibaca">
                                                <x-admin.ui.icons.mail-open />
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                @php
                    $hasSearch = request()->filled('search');
                    // Only consider sort a filter if it's NOT the default 'latest'
                    $hasFilter = request()->filled('status') || (request()->filled('sort') && request('sort') !== 'latest');
                @endphp
                @if($hasSearch && $hasFilter)
                    <div class="min-h-[300px] sm:min-h-[360px] flex flex-col items-center justify-center text-center">
                        <svg class="w-24 h-24 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                        <p class="text-sm font-semibold text-black mb-1">Data tidak ditemukan.</p>
                        <p class="text-sm text-black/60 mb-6 max-w-xs">Tidak ada pesan yang cocok dengan pencarian
                            "{{ request('search') }}" dan filter yang dipilih.</p>
                    </div>
                @elseif($hasSearch)
                    <div class="min-h-[300px] sm:min-h-[360px] flex flex-col items-center justify-center text-center">
                        <svg class="w-24 h-24 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                        <p class="text-sm font-semibold text-black mb-1">Hasil pencarian tidak ditemukan.</p>
                        <p class="text-sm text-black/60 mb-6 max-w-xs">Tidak ada pesan yang sesuai dengan pencarian
                            "{{ request('search') }}".</p>
                    </div>
                @elseif($hasFilter)
                    <div class="min-h-[300px] sm:min-h-[360px] flex flex-col items-center justify-center text-center">
                        <svg class="w-24 h-24 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                        <p class="text-sm font-semibold text-black mb-1">Data tidak ditemukan.</p>
                        <p class="text-sm text-black/60 mb-6 max-w-xs">Tidak ada pesan yang cocok dengan filter yang dipilih.</p>
                    </div>
                @else
                    <div class="py-28 flex flex-col items-center justify-center text-center">
                        {{-- Icon --}}
                        <svg class="w-24 h-24 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>

                        {{-- Description text --}}
                        <p class="text-sm text-black/60 mb-6 max-w-xs">Belum ada pesan yang masuk. Semua pertanyaan atau masukan
                            dari pengunjung website akan muncul di sini.</p>
                    </div>
                @endif
            @endif
            </div>
        </x-admin.ui.card>
    </div>
@endsection
