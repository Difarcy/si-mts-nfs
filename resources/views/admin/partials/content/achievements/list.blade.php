@if ($prestasi->count() > 0)
    {{-- Table View --}}
    <div x-show="view === 'table'" data-admin-view-panel="table">
        <div class="h-[300px] sm:h-[360px] overflow-y-auto">
            <x-admin.ui.table>
                <x-slot:thead>
                    <tr>
                        <th class="px-2 sm:px-4 py-2 sm:py-3 text-center text-[10px] sm:text-xs">Nama Lomba</th>
                        <th class="px-2 sm:px-4 py-2 sm:py-3 text-center w-28 sm:w-44 text-[10px] sm:text-xs">Nama Siswa
                        </th>
                        <th class="px-2 sm:px-4 py-2 sm:py-3 text-center w-24 sm:w-32 text-[10px] sm:text-xs">Kategori</th>
                        <th class="px-2 sm:px-4 py-2 sm:py-3 text-center w-28 sm:w-44 text-[10px] sm:text-xs">Tags</th>
                        <th class="px-2 sm:px-4 py-2 sm:py-3 text-center w-20 sm:w-28 text-[10px] sm:text-xs">Peringkat</th>
                        <th class="px-2 sm:px-4 py-2 sm:py-3 text-center w-20 sm:w-28 text-[10px] sm:text-xs">Status</th>
                        <th class="px-2 sm:px-4 py-2 sm:py-3 text-center w-20 sm:w-28 text-[10px] sm:text-xs">Aksi</th>
                    </tr>
                </x-slot:thead>

                @foreach ($prestasi as $item)
                    <tr class="hover:bg-gray-50/50 transition-colors" data-admin-item="table" data-id="{{ $item->id }}"
                        data-status="{{ $item->status }}" data-title="{{ $item->nama_lomba }}"
                        data-search="{{ $item->nama_siswa }} {{ $item->nama_lomba }} {{ $item->kelas }} {{ $item->tingkat }} {{ $item->tags }}">
                        <td class="px-2 sm:px-4 py-2 sm:py-3">
                            <div class="flex flex-col">
                                <span
                                    class="text-[11px] sm:text-sm font-bold text-black line-clamp-1 leading-tight text-left">{{ $item->nama_lomba }}</span>
                                <span
                                    class="text-[9px] sm:text-[11px] text-slate-900 line-clamp-1 mt-0.5 text-left">{{ Str::limit(strip_tags($item->deskripsi), 100) }}</span>
                            </div>
                        </td>
                        <td class="px-2 sm:px-4 py-2 sm:py-3 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <span class="text-[10px] sm:text-xs font-semibold text-black">{{ $item->nama_siswa }}</span>
                                <span class="text-[9px] sm:text-[11px] text-black font-medium">Kelas {{ $item->kelas }}</span>
                            </div>
                        </td>
                        <td class="px-2 sm:px-4 py-2 sm:py-3 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <span class="text-[10px] sm:text-xs font-semibold text-black">{{ $item->tingkat }}</span>
                                <span class="text-[9px] sm:text-[11px] text-black font-medium">{{ $item->jenis }}</span>
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
                        <td class="px-2 sm:px-4 py-2 sm:py-3 text-center">
                            <span class="text-[10px] sm:text-xs font-semibold text-black">{{ $item->peringkat }}</span>
                        </td>
                        <td class="px-2 sm:px-4 py-2 sm:py-3 text-center">
                            <x-admin.ui.badge :variant="$item->status" class="scale-75 sm:scale-100 origin-center">
                                {{ ucfirst($item->status) }}
                            </x-admin.ui.badge>
                        </td>
                        <td class="px-2 sm:px-4 py-2 sm:py-3">
                            <div class="flex items-center justify-center gap-1 sm:gap-2">
                                <x-admin.form.button variant="edit"
                                    href="{{ route('admin.konten.prestasi-siswa.edit', $item->id) }}" class="!p-1.5 sm:!p-2"
                                    title="Ubah">
                                    <x-slot:icon>
                                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </x-slot:icon>
                                </x-admin.form.button>

                                <x-admin.form.button variant="delete" class="!p-1.5 sm:!p-2" title="Hapus"
                                    data-achievement-delete data-achievement-id="{{ $item->id }}"
                                    data-achievement-title="{{ $item->nama_lomba }}">
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
    </div>

    {{-- Grid View --}}
    <div x-show="view === 'grid'" data-admin-view-panel="grid">
        <x-admin.ui.grid cols="grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($prestasi as $item)
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-all group relative flex flex-col h-full"
                    data-admin-item="grid" data-id="{{ $item->id }}" data-status="{{ $item->status }}"
                    data-title="{{ $item->nama_lomba }}"
                    data-search="{{ $item->nama_siswa }} {{ $item->nama_lomba }} {{ $item->kelas }} {{ $item->tingkat }} {{ $item->tags }}">
                    <div class="relative aspect-[4/3] overflow-hidden shrink-0">
                        @if($item->foto_siswa)
                            <img src="{{ asset('storage/' . $item->foto_siswa) }}" alt="Foto Siswa"
                                class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <div class="p-5 flex flex-col flex-grow min-h-[180px]">
                        <div class="mb-3 flex flex-wrap gap-1.5">
                            <x-admin.ui.badge :variant="$item->status" class="!px-2 !py-0.5 text-[9px] font-bold">
                                {{ ucfirst($item->status) }}
                            </x-admin.ui.badge>
                            <x-admin.ui.badge :variant="strtolower($item->peringkat)" class="!px-2 !py-0.5 text-[9px] font-bold">
                                {{ $item->peringkat }}
                            </x-admin.ui.badge>
                        </div>

                        @php
                            $tags = $item->tags
                                ? array_values(array_filter(array_map('trim', explode(',', (string) $item->tags))))
                                : [];
                            $visibleTags = array_slice($tags, 0, 3);
                            $remainingTags = count($tags) - count($visibleTags);
                        @endphp
                        @if(count($tags) > 0)
                            <div class="mb-3 flex flex-wrap gap-1.5">
                                @foreach($visibleTags as $tag)
                                    <span class="px-2 py-0.5 text-[9px] font-bold bg-gray-50 border border-black/10 rounded">{{ $tag }}</span>
                                @endforeach
                                @if($remainingTags > 0)
                                    <span class="px-2 py-0.5 text-[9px] font-bold text-slate-900">+{{ $remainingTags }}</span>
                                @endif
                            </div>
                        @endif

                        <div class="flex-grow space-y-1.5">
                            <h4
                                class="text-[13px] sm:text-[15px] font-bold text-black line-clamp-2 leading-tight text-justify">
                                {{ $item->nama_lomba }}
                            </h4>
                            
                            <div class="space-y-0.5">
                                <p class="text-[11px] sm:text-[12px] font-semibold text-slate-900 line-clamp-1">
                                    {{ $item->nama_siswa }} - Kelas {{ $item->kelas }}
                                </p>
                                <p class="text-[10px] sm:text-[11px] text-slate-900 line-clamp-1">
                                    {{ $item->tingkat }} - {{ $item->jenis }}
                                </p>
                            </div>

                            <p class="text-[10px] sm:text-[11px] text-slate-900 line-clamp-3 leading-relaxed text-justify pt-0.5">
                                {{ Str::limit(strip_tags($item->deskripsi), 100) }}
                            </p>
                        </div>

                        <div class="mt-2 flex items-center justify-between gap-2">
                            <div class="flex items-center gap-2 text-[9px] sm:text-[11px] text-slate-900 font-medium">
                                <div class="flex items-center gap-1">
                                    <svg class="w-3 h-3 text-slate-900" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span>{{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') : '-' }}</span>
                                </div>
                            </div>

                            <div class="flex gap-1 sm:gap-1.5">
                                <x-admin.form.button variant="edit"
                                    href="{{ route('admin.konten.prestasi-siswa.edit', $item->id) }}" class="!p-1.5 sm:!p-2"
                                    title="Ubah">
                                    <x-slot:icon>
                                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </x-slot:icon>
                                </x-admin.form.button>

                                <x-admin.form.button variant="delete" class="!p-1.5 sm:!p-2" title="Hapus"
                                    data-achievement-delete data-achievement-id="{{ $item->id }}"
                                    data-achievement-title="{{ $item->nama_lomba }}">
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
                        </div>
                    </div>
                </div>
            @endforeach
        </x-admin.ui.grid>
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
            <p class="text-sm text-black mb-6 max-w-xs">Tidak ada prestasi yang cocok dengan pencarian
                "{{ request('search') }}" dan filter yang dipilih.</p>
        </div>
    @elseif($hasSearch)
        <div class="min-h-[300px] sm:min-h-[360px] flex flex-col items-center justify-center text-center">
            <svg class="w-24 h-24 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
            </svg>
            <p class="text-sm font-semibold text-black mb-1">Hasil pencarian tidak ditemukan.</p>
            <p class="text-sm text-black/60 mb-6 max-w-xs">Tidak ada prestasi yang sesuai dengan pencarian
                "{{ request('search') }}".</p>
        </div>
    @elseif($hasFilter)
        <div class="min-h-[300px] sm:min-h-[360px] flex flex-col items-center justify-center text-center">
            <svg class="w-24 h-24 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
            </svg>
            <p class="text-sm font-semibold text-black mb-1">Data tidak ditemukan.</p>
            <p class="text-sm text-black/60 mb-6 max-w-xs">Tidak ada prestasi yang cocok dengan filter yang dipilih.</p>
        </div>
    @else
        <div class="min-h-[300px] sm:min-h-[360px] flex flex-col items-center justify-center text-center">
            <svg class="w-24 h-24 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <p class="text-sm text-black mb-6 max-w-xs">Mulai kelola prestasi siswa sekolah Anda dengan membuat data prestasi
                pertama.</p>
            <x-admin.form.button variant="add" href="{{ route('admin.konten.prestasi-siswa.create') }}"
                data-action="add-achievement">
                <x-slot:icon>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </x-slot:icon>
                Tambah Prestasi Pertama
            </x-admin.form.button>
        </div>
    @endif
@endif
