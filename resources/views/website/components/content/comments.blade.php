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
                            <x-website.form.input id="modal-nama" label="Nama" name="nama" required="true" placeholder="Nama Lengkap" autocomplete="name" />
                            <x-website.form.input id="modal-email" label="Email" name="email" type="email" required="true" placeholder="Alamat Email" autocomplete="email" />
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
