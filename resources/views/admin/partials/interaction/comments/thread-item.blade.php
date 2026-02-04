@php
    $isAdmin = ($item->author_type ?? 'visitor') === 'admin';
    $timeText = optional($item->tanggal)->format('d M Y, H:i');
    $liked = (bool) ($likedMap[$item->id] ?? false);
    $level = (int) ($level ?? 1);
@endphp

<div class="border-b border-gray-100 py-2 last:border-0 last:pb-0" data-thread-item data-comment-id="{{ $item->id }}"
    data-thread-id="{{ $item->thread_id }}" data-author-name="{{ $item->nama }}"
    style="margin-left: {{ ($level - 1) * 2 }}rem;">

    <div class="flex items-start gap-3">
        <div
            class="w-8 h-8 rounded-full bg-gray-100 border border-gray-900 flex items-center justify-center font-bold text-slate-900 shrink-0 text-sm">
            {{ mb_strtoupper(mb_substr($item->nama, 0, 1)) }}
        </div>

        <div class="flex-1 min-w-0">
            <div class="flex justify-between items-start gap-4 mb-0">
                <div class="flex flex-col gap-0">
                    <div class="flex flex-wrap items-center gap-x-2 gap-y-0 leading-tight">
                        <p class="text-xs sm:text-sm font-bold {{ $isAdmin ? 'text-green-700' : 'text-slate-900' }}">
                            {{ $item->nama }}
                        </p>
                        <span class="text-[10px] sm:text-xs text-black/40 font-normal">{{ $item->email }}</span>
                    </div>
                    <p class="text-[10px] sm:text-xs text-black/60 font-normal leading-tight">{{ $timeText }}</p>
                </div>

                <div class="flex items-center gap-3 shrink-0">
                    {{-- Like (Only for visitor comments) --}}
                    @if(!$isAdmin)
                        <button type="button"
                            class="group flex items-center gap-1.5 text-xs sm:text-sm font-bold transition-colors"
                            data-comment-like data-url="{{ route('admin.interaksi.komentar.like', $item->id) }}">
                            <div
                                class="like-icon-wrapper {{ $liked ? 'text-green-700' : 'text-slate-900 group-hover:text-green-700' }}">
                                <span class="icon-liked {{ $liked ? '' : 'hidden' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-current" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <span class="icon-unliked {{ !$liked ? '' : 'hidden' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </span>
                            </div>
                            <span
                                class="like-text {{ $liked ? 'text-green-700' : 'text-slate-900 group-hover:text-green-700' }}">Suka</span>
                            <span class="like-count {{ $likeCount > 0 ? '' : 'hidden' }} {{ $liked ? 'text-green-700' : 'text-slate-900 group-hover:text-green-700' }} ml-0.5">{{ $likeCount > 0 ? $likeCount : '' }}</span>
                        </button>
                    @endif





                    {{-- Delete Button (Only for Admin comments in thread) --}}
                    @if ($isAdmin)
                        <button type="button" class="text-slate-900 hover:text-red-600 transition-colors" title="Hapus"
                            data-delete-thread-item data-url="{{ route('admin.interaksi.komentar.destroy', $item->id) }}">
                            <x-admin.ui.icons.trash class="w-4 h-4" />
                        </button>
                    @endif

                    @if($isAdmin && ($item->liked_by_public_count ?? 0) > 0)
                        <div class="flex items-center gap-1.5 text-xs sm:text-sm font-bold text-green-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-current" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>{{ $item->liked_by_public_count }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <div class="text-xs sm:text-sm text-slate-900 leading-snug whitespace-pre-line text-justify -mt-2">
                {{ trim($item->isi) }}
            </div>
        </div>
    </div>
</div>