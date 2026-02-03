@if ($agenda->count() > 0)
    <div class="h-[300px] sm:h-[360px] overflow-y-auto">
        <x-admin.ui.table>
            <x-slot:thead>
                <tr>
                    <th class="px-2 sm:px-4 py-2 sm:py-3 text-center text-[10px] sm:text-xs">Judul</th>
                    <th class="px-2 sm:px-4 py-2 sm:py-3 text-center w-28 sm:w-44 text-[10px] sm:text-xs">Tags</th>
                    <th class="px-2 sm:px-4 py-2 sm:py-3 text-center w-28 sm:w-44 text-[10px] sm:text-xs">Tanggal Acara</th>
                    <th class="px-2 sm:px-4 py-2 sm:py-3 text-center w-28 sm:w-44 text-[10px] sm:text-xs">Tanggal Publikasi</th>
                    <th class="px-2 sm:px-4 py-2 sm:py-3 text-center w-20 sm:w-28 text-[10px] sm:text-xs">Status</th>
                    <th class="px-2 sm:px-4 py-2 sm:py-3 text-center w-20 sm:w-28 text-[10px] sm:text-xs">Aksi</th>
                </tr>
            </x-slot:thead>

            @foreach ($agenda as $item)
                @php
                    $isLocked = $item->tanggal_publikasi && $item->tanggal_publikasi->isFuture();
                @endphp
                <tr class="hover:bg-gray-50/50 transition-colors" data-admin-item="table" data-id="{{ $item->id }}"
                    data-status="{{ $item->status }}" data-title="{{ $item->judul }}"
                    data-search="{{ $item->judul }} {{ strip_tags($item->deskripsi) }} {{ $item->tags }}">
                    <td class="px-2 sm:px-4 py-2 sm:py-3">
                        <div class="flex flex-col">
                            <span
                                class="text-[11px] sm:text-sm font-bold text-black line-clamp-1 leading-tight">{{ $item->judul }}</span>
                            <span
                                    class="text-[9px] sm:text-[11px] text-slate-900 line-clamp-1 mt-0.5">{{ Str::limit(strip_tags($item->deskripsi), 150) }}</span>
                            </div>
                        </td>
                    <td class="px-2 sm:px-4 py-2 sm:py-3">
                        @php
                            $tags = $item->tags
                                ? array_values(array_filter(array_map('trim', explode(',', (string) $item->tags))))
                                : [];
                            $visibleTags = array_slice($tags, 0, 3);
                            $remainingTags = count($tags) - count($visibleTags);
                        @endphp
                        <div class="flex flex-wrap justify-center gap-1">
                            @foreach($visibleTags as $tag)
                                <span class="px-2 py-0.5 text-[9px] font-bold bg-gray-50 border border-black/10 rounded">{{ $tag }}</span>
                            @endforeach
                            @if($remainingTags > 0)
                                <span class="px-2 py-0.5 text-[9px] font-bold text-slate-900">+{{ $remainingTags }}</span>
                            @endif
                            @if(count($tags) === 0)
                                <span class="text-[9px] sm:text-[11px] text-slate-900">-</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-2 sm:px-4 py-2 sm:py-3 text-center text-black">
                        <div class="flex flex-col items-center justify-center whitespace-nowrap">
                            <span class="text-[9px] sm:text-xs font-semibold text-black">
                                {{ $item->tanggal_mulai ? $item->tanggal_mulai->format('m/d/Y') : '-' }}
                                @if($item->tanggal_selesai)
                                    - {{ $item->tanggal_selesai->format('m/d/Y') }}
                                @endif
                            </span>
                            @if($item->waktu_mulai)
                                <span class="text-[9px] sm:text-xs font-semibold text-black mt-0.5">
                                    {{ \Carbon\Carbon::parse($item->waktu_mulai)->format('H:i') }}
                                    -
                                    {{ $item->waktu_selesai ? \Carbon\Carbon::parse($item->waktu_selesai)->format('H:i') : 'Selesai' }}
                                    WIB
                                </span>
                            @endif
                        </div>
                    </td>
                    <td class="px-2 sm:px-4 py-2 sm:py-3 text-center text-black">
                        <div class="flex flex-col sm:flex-row items-center justify-center sm:gap-2 whitespace-nowrap">
                            <span
                                class="text-[9px] sm:text-xs font-semibold text-black">{{ $item->tanggal_publikasi ? $item->tanggal_publikasi->format('m/d/Y') : '-' }}</span>
                            @if($item->tanggal_publikasi)
                                <div class="hidden sm:block w-px h-3 bg-black"></div>
                                <span
                                    class="text-[9px] sm:text-xs font-semibold text-black">{{ $item->tanggal_publikasi->format('H:i') }}</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-2 sm:px-4 py-2 sm:py-3 text-center">
                        <x-admin.ui.badge :variant="$item->status" class="scale-75 sm:scale-100 origin-center">
                            {{ ucfirst($item->status) }}
                        </x-admin.ui.badge>
                    </td>
                    <td class="px-2 sm:px-4 py-2 sm:py-3">
                        <div class="flex items-center justify-center gap-1 sm:gap-2">
                            @if($isLocked)
                                <x-admin.form.button variant="edit" type="button" disabled
                                    class="!p-1.5 sm:!p-2 !bg-slate-300 !text-slate-600 cursor-not-allowed hover:!bg-slate-300"
                                    title="Tidak bisa diubah sebelum waktu publish">
                                    <x-slot:icon>
                                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                            </path>
                                        </svg>
                                    </x-slot:icon>
                                </x-admin.form.button>
                            @else
                                <x-admin.form.button variant="edit" href="{{ route('admin.konten.agenda.edit', $item->id) }}"
                                    class="!p-1.5 sm:!p-2" title="Ubah">
                                    <x-slot:icon>
                                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </x-slot:icon>
                                </x-admin.form.button>
                            @endif

                            <x-admin.form.button variant="delete" class="!p-1.5 sm:!p-2" title="Hapus" data-agenda-delete
                                data-agenda-id="{{ $item->id }}" data-agenda-title="{{ $item->judul }}">
                                <x-slot:icon>
                                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </x-slot:icon>
                            </x-admin.form.button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </x-admin.ui.table>
    </div>
@else
    @php
        $hasSearch = request()->filled('search');
        $hasFilter = request()->filled('status') || request()->filled('sort');
    @endphp
    @if($hasSearch && $hasFilter)
        <div class="min-h-[300px] sm:min-h-[360px] flex flex-col items-center justify-center text-center">
            <svg class="w-24 h-24 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
            </svg>
            <p class="text-sm font-semibold text-black mb-1">Data tidak ditemukan.</p>
            <p class="text-sm text-black mb-6 max-w-xs">Tidak ada agenda yang cocok dengan pencarian
                "{{ request('search') }}" dan filter yang dipilih.</p>
        </div>
    @elseif($hasSearch)
        <div class="min-h-[300px] sm:min-h-[360px] flex flex-col items-center justify-center text-center">
            <svg class="w-24 h-24 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
            </svg>
            <p class="text-sm font-semibold text-black mb-1">Hasil pencarian tidak ditemukan.</p>
            <p class="text-sm text-black/60 mb-6 max-w-xs">Tidak ada agenda yang sesuai dengan pencarian
                "{{ request('search') }}".</p>
        </div>
    @elseif($hasFilter)
        <div class="min-h-[300px] sm:min-h-[360px] flex flex-col items-center justify-center text-center">
            <svg class="w-24 h-24 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
            </svg>
            <p class="text-sm font-semibold text-black mb-1">Data tidak ditemukan.</p>
            <p class="text-sm text-black/60 mb-6 max-w-xs">Tidak ada agenda yang cocok dengan filter yang dipilih.</p>
        </div>
    @else
        <div class="min-h-[300px] sm:min-h-[360px] flex flex-col items-center justify-center text-center">
            <svg class="w-24 h-24 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <p class="text-sm text-black mb-6 max-w-xs">Mulai kelola agenda sekolah Anda dengan membuat agenda pertama.</p>
            <x-admin.form.button variant="add" href="{{ route('admin.konten.agenda.create') }}" data-action="add-agenda">
                <x-slot:icon>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </x-slot:icon>
                Tambah Agenda Pertama
            </x-admin.form.button>
        </div>
    @endif
@endif
