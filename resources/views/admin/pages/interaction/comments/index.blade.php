@extends('admin.layouts.admin')

@section('title', 'Komentar')

@section('content')
    <div class="flex flex-col gap-3" data-page="comment-list">
        <x-admin.ui.page-header title="Komentar" subtitle="Kelola komentar yang masuk dari pengunjung website">
            <x-slot:actions>
                <div class="flex items-center gap-2 sm:gap-3"></div>
            </x-slot:actions>
        </x-admin.ui.page-header>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <div id="stats-total-wrapper">
                <x-admin.ui.stats-card label="Total" :value="$totalCount ?? 0" color="blue">
                    <x-slot:icon>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                    </x-slot:icon>
                </x-admin.ui.stats-card>
            </div>

            <div id="stats-pending-wrapper">
                <x-admin.ui.stats-card label="Pending" :value="$pendingCount ?? 0" color="yellow">
                    <x-slot:icon>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </x-slot:icon>
                </x-admin.ui.stats-card>
            </div>

            <div id="stats-approved-wrapper">
                <x-admin.ui.stats-card label="Disetujui" :value="$approvedCount ?? 0" color="green">
                    <x-slot:icon>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </x-slot:icon>
                </x-admin.ui.stats-card>
            </div>

            <div id="stats-unread-wrapper">
                <x-admin.ui.stats-card label="Belum Dibaca" :value="$unreadCount ?? 0" color="red">
                    <x-slot:icon>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </x-slot:icon>
                </x-admin.ui.stats-card>
            </div>
        </div>

        <x-admin.ui.card data-admin-list="true" data-admin-list-mode="server" bodyClass="p-0">
            <x-slot:header>
                <div class="flex flex-wrap gap-1.5 sm:gap-2 items-center">
                    <x-admin.form.input-search placeholder="Cari komentar..." name="search" value="{{ request('search') }}"
                        :autocomplete="'off'" />

                    <div class="flex gap-1.5 sm:gap-2">
                        <x-admin.form.filter-sort name="status">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Disetujui</option>
                        </x-admin.form.filter-sort>

                        <x-admin.form.filter-sort name="sort">
                            <option value="latest" {{ request('sort', 'latest') === 'latest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Terlama</option>
                            <option value="az" {{ request('sort') === 'az' ? 'selected' : '' }}>A-Z</option>
                            <option value="za" {{ request('sort') === 'za' ? 'selected' : '' }}>Z-A</option>
                        </x-admin.form.filter-sort>
                    </div>
                </div>
            </x-slot:header>

            <x-admin.interaction.list-toolbar :items="$comments" paginationId="comment-pagination-container">
                <x-slot:dropdownItems>
                    <button type="button" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-50">Semua</button>
                    <button type="button" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-50">Tidak ada</button>
                    <button type="button" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-50">Belum dibaca</button>
                    <button type="button" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-50">Dibaca</button>
                </x-slot:dropdownItems>

                <x-slot:defaultActions>
                    <button class="toolbar-btn-default p-2 text-gray-600 hover:bg-gray-100 rounded-full transition-colors" title="Tandai Semua Dibaca" data-url="{{ route('admin.interaksi.komentar.mark-all-read', request()->query()) }}" data-method="PUT">
                        <x-admin.ui.icons.mail-open />
                    </button>
                </x-slot:defaultActions>

                <x-slot:bulkActions>
                    <button class="p-2 text-gray-600 hover:text-red-600 hover:bg-gray-100 rounded-full transition-colors" title="Hapus Terpilih">
                        <x-admin.ui.icons.trash />
                    </button>

                    <button id="bulk-toggle-read-btn" class="p-2 text-gray-600 hover:text-black hover:bg-gray-100 rounded-full transition-colors" title="Tandai Dibaca">
                        <x-admin.ui.icons.mail-open />
                    </button>

                    <button id="bulk-toggle-status-btn" class="p-2 text-gray-600 hover:text-black hover:bg-gray-100 rounded-full transition-colors" title="Setujui">
                        <x-admin.ui.icons.check />
                    </button>
                </x-slot:bulkActions>
            </x-admin.interaction.list-toolbar>

            <div id="comment-list-container">
                @if($comments->count() > 0)
                    <div class="h-[500px] overflow-y-auto">
                        <div class="flex flex-col border-t border-gray-200">
                            @foreach($comments as $comment)
                                @php
                                    $typeLabels = [
                                        'news' => 'Berita',
                                        'article' => 'Artikel',
                                        'announcement' => 'Pengumuman',
                                        'agenda' => 'Agenda',
                                        'achievement' => 'Prestasi Siswa',
                                    ];
                                    $typeLabel = $typeLabels[$comment->konten_tipe] ?? $comment->konten_tipe;
                                    // isUnread logic: true if DB field is false AND no unread replies (if we care about replies)
                                    // Actually, let's trust the DB field 'is_read'.
                                    // If unread_replies_count > 0, we might want to highlight it too, but 'is_read' is primary.
                                    $isUnread = !$comment->is_read;
                                    $commentStatus = $comment->status;
                                    $commentDate = $comment->tanggal;
                                @endphp
                                <div class="comment-row group flex items-center px-3 sm:px-4 py-2 border-b border-gray-200 hover:shadow-[0_1px_3px_0_rgba(60,64,67,0.3),0_4px_8px_3px_rgba(60,64,67,0.15)] hover:z-10 relative transition-shadow cursor-pointer {{ $commentStatus === 'pending' ? 'bg-yellow-50' : '' }} {{ $isUnread ? 'font-bold' : 'font-normal' }}"
                                    data-status="{{ $commentStatus }}"
                                    data-read="{{ $isUnread ? '0' : '1' }}"
                                    onclick="if(!event.target.closest('.comment-checkbox-container') && !event.target.closest('button') && !event.target.closest('input') && !event.target.closest('a')) window.location='{{ route('admin.interaksi.komentar.show', $comment->id) }}'">

                                    <div class="flex items-stretch h-8 flex-shrink-0 comment-checkbox-container z-20 relative" onclick="event.stopPropagation()">
                                        <div class="px-2 rounded-sm hover:bg-gray-200 cursor-pointer flex items-center justify-center transition-colors" onclick="this.querySelector('input').click()">
                                            <div class="w-4 h-4 border-2 border-gray-500 rounded sm:w-4 sm:h-4 flex items-center justify-center bg-white relative pointer-events-none">
                                                <input type="checkbox" class="comment-checkbox w-full h-full opacity-0 cursor-pointer absolute z-10 pointer-events-auto" value="{{ $comment->id }}" onclick="event.stopPropagation()">
                                                <svg class="w-3 h-3 text-gray-600 hidden checked-icon pointer-events-none" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg>
                                            </div>
                                        </div>
                                    </div>

                                    <div data-comment-name class="w-[7.5rem] sm:w-[9.5rem] md:w-[11.5rem] flex-shrink-0 font-roboto-slab truncate text-xs sm:text-sm {{ $isUnread ? 'font-bold text-black' : 'text-black' }}">
                                        {{ $comment->nama }}
                                    </div>

                                    <div class="flex-1 min-w-0 font-roboto-slab grid grid-cols-[auto_1fr] items-center gap-1">
                                        <div class="flex items-center gap-1.5 truncate">
                                            <span data-comment-type class="truncate text-xs sm:text-sm {{ $isUnread ? 'font-bold text-black' : 'text-black' }}">
                                                {{ $typeLabel }}
                                            </span>
                                        </div>
                                        <span class="text-xs sm:text-sm text-black truncate font-normal">
                                            - {{ $comment->isi }}
                                        </span>
                                    </div>

                                    <div class="w-24 sm:w-32 flex-shrink-0 text-right px-2 flex items-center justify-end relative">
                                        <span class="text-[10px] sm:text-xs whitespace-nowrap group-hover:hidden {{ $commentStatus === 'pending' && $isUnread ? 'text-black' : 'text-black/60 font-normal' }}">
                                            @if($commentDate && $commentDate->isToday())
                                                {{ $commentDate->format('H:i') }}
                                            @elseif($commentDate && $commentDate->isCurrentYear())
                                                {{ $commentDate->format('M d') }}
                                            @else
                                                {{ $commentDate ? $commentDate->format('j/n/y') : '-' }}
                                            @endif
                                        </span>

                                        <div class="hidden group-hover:flex items-center justify-end gap-1 absolute right-2 top-1/2 -translate-y-1/2 pl-2">
                                            <form action="{{ route('admin.interaksi.komentar.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Hapus komentar ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-gray-500 hover:text-red-600 hover:bg-gray-100 rounded-full transition-colors" title="Hapus" onclick="event.stopPropagation()">
                                                    <x-admin.ui.icons.trash />
                                                </button>
                                            </form>

                                            @if(!$isUnread)
                                                <button type="button" data-url="{{ route('admin.interaksi.komentar.mark-unread', $comment->id) }}" data-method="PUT"
                                                    class="action-btn-ajax p-2 text-gray-500 hover:text-black hover:bg-gray-100 rounded-full transition-colors" title="Tandai Belum Dibaca">
                                                    <x-admin.ui.icons.mail />
                                                </button>
                                            @else
                                                <button type="button" data-url="{{ route('admin.interaksi.komentar.mark-read', $comment->id) }}" data-method="PUT"
                                                    class="action-btn-ajax p-2 text-gray-500 hover:text-black hover:bg-gray-100 rounded-full transition-colors" title="Tandai Dibaca">
                                                    <x-admin.ui.icons.mail-open />
                                                </button>
                                            @endif

                                            @if($commentStatus !== 'approved')
                                                <button type="button" data-url="{{ route('admin.interaksi.komentar.mark-approved', $comment->id) }}" data-method="PUT"
                                                    class="action-btn-ajax p-2 text-gray-500 hover:text-black hover:bg-gray-100 rounded-full transition-colors" title="Setujui"
                                                    onclick="if(!confirm('Apakah Anda yakin ingin menyetujui komentar ini?')) return false;">
                                                    <x-admin.ui.icons.check />
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
                        $hasFilter = request()->filled('status') || (request()->filled('sort') && request('sort') !== 'latest');
                    @endphp
                    @if($hasSearch && $hasFilter)
                        <div class="min-h-[300px] sm:min-h-[360px] flex flex-col items-center justify-center text-center">
                            <svg class="w-24 h-24 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                </path>
                            </svg>
                            <p class="text-sm font-semibold text-black mb-1">Data tidak ditemukan.</p>
                            <p class="text-sm text-black/60 mb-6 max-w-xs">Tidak ada komentar yang cocok dengan pencarian "{{ request('search') }}" dan filter yang dipilih.</p>
                        </div>
                    @elseif($hasSearch)
                        <div class="min-h-[300px] sm:min-h-[360px] flex flex-col items-center justify-center text-center">
                            <svg class="w-24 h-24 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                </path>
                            </svg>
                            <p class="text-sm font-semibold text-black mb-1">Hasil pencarian tidak ditemukan.</p>
                            <p class="text-sm text-black/60 mb-6 max-w-xs">Tidak ada komentar yang sesuai dengan pencarian "{{ request('search') }}".</p>
                        </div>
                    @elseif($hasFilter)
                        <div class="min-h-[300px] sm:min-h-[360px] flex flex-col items-center justify-center text-center">
                            <svg class="w-24 h-24 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                </path>
                            </svg>
                            <p class="text-sm font-semibold text-black mb-1">Data tidak ditemukan.</p>
                            <p class="text-sm text-black/60 mb-6 max-w-xs">Tidak ada komentar yang cocok dengan filter yang dipilih.</p>
                        </div>
                    @else
                        <div class="min-h-[300px] sm:min-h-[360px] flex flex-col items-center justify-center text-center">
                            <svg class="w-24 h-24 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                </path>
                            </svg>
                            <p class="text-sm font-semibold text-black mb-1">Belum ada komentar.</p>
                            <p class="text-sm text-black/60 mb-6 max-w-xs">Komentar dari pengunjung website akan muncul di sini.</p>
                        </div>
                    @endif
                @endif
            </div>
        </x-admin.ui.card>
    </div>
@endsection
