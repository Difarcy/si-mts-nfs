@props([
    'contentType',
    'contentId',
    'comments' => collect(),
])

<section id="comments-section">
    <x-website.components.layout.page-title title="Komentar" margin="mb-2" />

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if ($errors->hasBag('comment'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->comment->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($comments->isNotEmpty())
        <div class="space-y-4 mb-3">
            @php
                $rootComments = $comments->where('parent_id', null);
            @endphp
            @foreach ($rootComments as $comment)
                <x-website.components.content.comment-item :comment="$comment" :allComments="$comments" />
            @endforeach
        </div>
    @else
        <p class="text-sm text-black/60 mb-3">Belum ada komentar. Jadilah yang pertama berkomentar!</p>
    @endif

    <div class="mt-3" id="comment-form-container">
        <div class="bg-gray-50 rounded-xl border border-gray-100">
            <div class="pt-3">
                <x-website.components.layout.page-title title="Tinggalkan Komentar" margin="mb-2" />
            </div>

            <div class="px-4 pb-3">
                @if(auth()->check())
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-3">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-blue-100 text-blue-600 rounded-full shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-blue-800">Mode Administrator</h4>
                                <p class="text-xs text-blue-700 mt-0.5">
                                    Anda sedang login. Formulir komentar baru dinonaktifkan. 
                                    Anda dapat membalas komentar pengunjung melalui tombol <strong>Balas</strong> pada komentar yang tersedia.
                                </p>
                            </div>
                        </div>
                    </div>
                @else
                <p class="text-sm text-black mb-3 font-lato" id="form-instruction">Kami mengharapkan tanggapan dan masukan Anda untuk mendukung kegiatan dan informasi sekolah.</p>

                <form method="POST" action="{{ route('web.komentar.store', ['type' => $contentType, 'id' => $contentId]) }}" class="space-y-4" data-comment-form="true">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <x-website.form.input label="Nama" name="nama" required="true" placeholder="Nama Lengkap" />
                        <x-website.form.input label="Email" name="email" type="email" required="true" placeholder="Alamat Email" />
                    </div>

                    <x-website.form.textarea label="Komentar" name="isi" rows="10" required="true" placeholder="Tulis komentar Anda disini..." />

                    <div class="pt-0">
                        <x-website.components.form.button type="submit">
                            <span class="tracking-wider text-[10px] sm:text-sm uppercase">Kirim Komentar</span>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-3 w-3 sm:h-4 sm:w-4 transform group-hover:translate-x-1 transition-transform"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </x-website.components.form.button>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>

    {{-- Reply Modal (Drawer style like Admin) --}}
    <div id="reply-modal" class="fixed inset-0 z-[90] pointer-events-none hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="absolute inset-0 bg-transparent opacity-0 transition-opacity" data-reply-backdrop data-action="close-reply-modal"></div>

        <div id="reply-modal-panel" class="absolute bottom-0 right-0 w-full sm:w-[520px] transform translate-y-full transition-transform duration-300 ease-out" data-reply-panel>
            <div class="bg-white border border-gray-200 shadow-xl rounded-t-2xl sm:rounded-t-2xl sm:rounded-b-none overflow-hidden flex flex-col h-[48vh] sm:h-[400px] max-h-[60vh]" data-reply-shell>
                <div class="flex items-center justify-between px-4 py-3 border-b border-gray-200 bg-white" data-reply-header>
                    <div class="min-w-0">
                        <div class="text-sm font-bold text-black" id="modal-title">Balas</div>
                        <div class="text-xs text-black/60 font-medium truncate">
                            Membalas komentar dari: <span id="modal-reply-target">-</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <button type="button" class="p-1.5 rounded-md hover:bg-gray-100 transition-colors" data-action="close-reply-modal" title="Tutup">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="px-4 py-4 flex-1 overflow-auto flex flex-col" data-reply-body>
                    <form method="POST" action="{{ route('web.komentar.store', ['type' => $contentType, 'id' => $contentId]) }}" class="flex flex-col flex-1 min-h-0 gap-3" data-comment-form="true">
                        @csrf
                        <input type="hidden" name="thread_id" id="modal-thread-id">
                        <input type="hidden" name="parent_id" id="modal-parent-id">

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @if(auth()->check())
                                @php
                                    $adminUser = auth()->user();
                                    $adminName = $adminUser->nama ?? 'Admin'; // Ambil nama dari DB, fallback 'Admin'
                                @endphp
                                <input type="hidden" name="email" value="{{ $adminUser->email }}">
                                
                                <div class="col-span-1 sm:col-span-2 bg-green-50 px-4 py-3 rounded-lg border border-green-200 flex flex-col gap-2">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-full bg-green-100 flex items-center justify-center text-green-700 font-bold text-sm border border-green-200 shrink-0">
                                            {{ mb_strtoupper(mb_substr($adminName, 0, 1)) }}
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs text-gray-500 font-medium">Membalas sebagai:</p>
                                            <div class="flex items-center gap-2">
                                                <input type="text" name="nama" value="{{ $adminName }}" 
                                                    class="text-sm font-bold text-green-800 bg-transparent border-b border-green-300 focus:border-green-600 focus:outline-none w-full sm:w-auto transition-colors placeholder-green-800/50" 
                                                    placeholder="Nama Tampilan">
                                                <span class="text-green-600 font-normal text-xs shrink-0">(Admin)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-[10px] text-green-600 italic ml-12">Klik nama untuk mengubah tampilan nama balasan.</p>
                                </div>
                            @else
                                <x-website.form.input id="modal-nama" label="Nama" name="nama" required="true" placeholder="Nama Lengkap" autocomplete="name" />
                                <x-website.form.input id="modal-email" label="Email" name="email" type="email" required="true" placeholder="Alamat Email" autocomplete="email" />
                            @endif
                        </div>

                        <x-website.form.textarea id="modal-isi" label="Balasan" name="isi" rows="4" required="true" placeholder="Tulis balasan..." wrapperClass="flex-1 flex flex-col min-h-0" class="flex-1 min-h-0" />

                        <div class="mt-auto pt-2 flex items-center justify-end gap-2">
                            <x-website.components.form.button type="button" variant="danger" data-action="close-reply-modal">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                <span class="tracking-wider text-[10px] sm:text-sm uppercase">Batal</span>
                            </x-website.components.form.button>

                            <x-website.components.form.button type="submit" variant="primary">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="tracking-wider text-[10px] sm:text-sm uppercase">Kirim</span>
                            </x-website.components.form.button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
