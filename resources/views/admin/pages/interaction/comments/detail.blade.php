@extends('admin.layouts.admin')

@section('title', 'Detail Komentar')

@section('content')
    <div class="flex flex-col gap-3" data-page="comment-detail" 
        data-thread-id="{{ $threadRoot->id }}" 
        data-comment-id="{{ $comment->id }}"
        data-thread-root-name="{{ $threadRoot->nama }}"
        data-reply-url="{{ route('admin.interaksi.komentar.reply', $threadRoot->id) }}">
        {{-- Header --}}
        <x-admin.ui.page-header title="Detail Komentar"
            subtitle="Tinjau dan kelola balasan untuk komentar pengunjung website">
            <x-slot:actions>
                <x-admin.form.button variant="secondary" href="{{ route('admin.interaksi.komentar.index') }}"
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

        @php
            $variantMap = [
                'Berita' => 'berita',
                'Artikel' => 'artikel',
                'Pengumuman' => 'pengumuman',
                'Agenda' => 'agenda',
                'Prestasi Siswa' => 'prestasi',
            ];
            $contentVariant = $variantMap[$contentInfo['label'] ?? ''] ?? 'default';
        @endphp

        <div class="flex flex-col gap-4">
            <x-admin.ui.card>
                <x-slot:header>
                    <div class="flex items-center justify-between gap-3">
                        <div class="text-sm sm:text-base font-bold text-black">Postingan {{ $contentInfo['label'] ?? '' }}</div>
                        @if(!empty($contentInfo['url']))
                            <x-admin.form.button href="{{ $contentInfo['url'] }}" variant="info" target="_blank" rel="noopener">
                                <x-slot:icon>
                                    <x-admin.ui.icons.external-link />
                                </x-slot:icon>
                                Buka
                            </x-admin.form.button>
                        @endif
                    </div>
                </x-slot:header>

                <div class="p-4 sm:p-6 bg-white">
                    <div class="min-w-0">
                        <div class="text-sm sm:text-base font-bold text-black">
                            {{ $contentInfo['title'] ?? 'Tidak ditemukan' }}
                        </div>

                        @if(!empty($contentInfo['excerpt']))
                            <div class="mt-2 text-xs sm:text-sm text-black/60 font-normal line-clamp-4 text-justify">
                                {{ $contentInfo['excerpt'] }}
                            </div>
                        @endif
                    </div>
                </div>
            </x-admin.ui.card>

            {{-- Card 2: Isi Komentar Utama --}}
            <x-admin.ui.card>
                <x-slot:header>
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <div>
                            <div class="text-sm sm:text-base font-bold text-black">Isi Komentar</div>
                            <div class="text-xs sm:text-sm text-black/60 font-normal">Dikirim: {{ optional($comment->tanggal)->format('d M Y, H:i') }} WIB</div>
                        </div>

                        <div class="flex items-center gap-2 justify-end">
                            @if ($comment->status === 'pending')
                                <form action="{{ route('admin.interaksi.komentar.mark-approved', $comment->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <x-admin.form.button type="submit" variant="info">
                                        <x-slot:icon>
                                            <x-admin.ui.icons.check />
                                        </x-slot:icon>
                                        Setujui
                                    </x-admin.form.button>
                                </form>
                            @endif

                            <x-admin.form.button variant="primary" data-open-reply>
                                <x-slot:icon>
                                    <x-admin.ui.icons.mail />
                                </x-slot:icon>
                                Balas
                            </x-admin.form.button>

                            <form action="{{ route('admin.interaksi.komentar.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Hapus komentar?');">
                                @csrf
                                @method('DELETE')
                                <x-admin.form.button type="submit" variant="delete">
                                    <x-slot:icon>
                                        <x-admin.ui.icons.trash />
                                    </x-slot:icon>
                                    Hapus
                                </x-admin.form.button>
                            </form>
                        </div>
                    </div>
                </x-slot:header>

                <div class="py-0 px-4 sm:px-6 bg-white">
                    <div class="text-sm sm:text-base text-slate-900 leading-relaxed whitespace-pre-line text-justify -mt-3 mb-4">
                        {{ trim($comment->isi) }}
                    </div>
                </div>
            </x-admin.ui.card>

            {{-- Card 3: Tampilan Komentar (Utas/Tangga) --}}
            <x-admin.ui.card>
                <x-slot:header>
                    <div class="text-sm sm:text-base font-bold text-black">Tampilan Komentar</div>
                </x-slot:header>

                <div class="p-4 sm:p-6 bg-white">
                    <div class="space-y-0" id="comment-thread" data-thread-container>
                        @include('admin.partials.interaction.comments.recursive-thread', [
                            'comments' => $thread,
                            'parentId' => $threadRoot->id,
                            'level' => 1,
                            'likedMap' => $likedMap,
                            'likeCounts' => $likeCounts
                        ])
                    </div>
                </div>
            </x-admin.ui.card>
        </div>

        <div class="fixed inset-0 z-[90] pointer-events-none" data-reply-drawer>
            <div class="absolute inset-0 bg-transparent opacity-0 transition-opacity" data-reply-backdrop></div>

            <div class="absolute bottom-0 right-0 w-full sm:w-[520px] transform translate-y-full transition-transform" data-reply-panel>
                <div class="bg-white border border-gray-200 shadow-xl rounded-t-2xl sm:rounded-t-2xl sm:rounded-b-none overflow-hidden flex flex-col h-[60vh] sm:h-[520px] max-h-[75vh]" data-reply-shell>
                    <div class="flex items-center justify-between px-4 py-3 border-b border-gray-200 bg-white" data-reply-header>
                        <div class="min-w-0">
                            <div class="text-xs sm:text-sm font-bold text-black">Balas</div>
                            <div class="text-[10px] sm:text-xs text-black/60 font-medium truncate">
                                Membalas komentar dari: <span data-reply-to-name>-</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <button type="button" class="p-1.5 rounded-md hover:bg-gray-100 transition-colors" data-reply-minimize title="Minimize">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12h12"></path>
                                </svg>
                            </button>
                            <button type="button" class="p-1.5 rounded-md hover:bg-gray-100 transition-colors" data-reply-close title="Tutup">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="px-4 py-4 flex-1 overflow-auto flex flex-col" data-reply-body>
                        @php
                            $adminUser = auth()->user();
                            $adminName = $adminUser?->nama ?? 'Admin';
                        @endphp

                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-green-700 text-white flex items-center justify-center font-bold text-sm shrink-0">
                                <span data-reply-avatar-initial>{{ mb_strtoupper(mb_substr($adminName, 0, 1)) }}</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2">
                                    <input type="text" name="nama" value="{{ $adminName }}" placeholder="Nama" autocomplete="name"
                                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm text-black placeholder-black/40 focus:outline-none focus:border-green-700"
                                        data-reply-name>
                                </div>
                            </div>
                        </div>

                        <form data-reply-form class="mt-3 flex flex-col flex-1 min-h-0">
                            <textarea name="isi" class="w-full flex-1 min-h-[160px] border border-gray-200 rounded-xl px-3 py-2 text-xs sm:text-sm text-black placeholder-black/40 focus:outline-none focus:border-green-700" placeholder="Tulis balasan..." required data-reply-textarea></textarea>

                            <div class="mt-3 flex items-center justify-end gap-2">
                                <x-admin.form.button variant="secondary" data-reply-cancel>
                                    <x-slot:icon>
                                        <x-admin.ui.icons.x />
                                    </x-slot:icon>
                                    Batal
                                </x-admin.form.button>
                                <x-admin.form.button variant="primary" type="submit" data-reply-submit>
                                    <x-slot:icon>
                                        <x-admin.ui.icons.check />
                                    </x-slot:icon>
                                    Kirim
                                </x-admin.form.button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
