@props([
    'comment',
    'allComments',
    'level' => 1
])

<div class="relative {{ $level === 1 ? 'border-b border-gray-100 pb-6 mb-6 last:border-0 last:pb-0 last:mb-0' : 'mt-4' }}">
    <div class="flex items-start gap-3 sm:gap-4">
        <div class="w-10 h-10 rounded-full bg-gray-100 border border-gray-900 flex items-center justify-center font-bold text-slate-900 shrink-0">
            {{ mb_strtoupper(mb_substr($comment->nama, 0, 1)) }}
        </div>
        <div class="flex-1 font-lato min-w-0">
            <div class="flex flex-wrap items-center gap-x-2 gap-y-1 mb-1">
                <p class="text-base font-bold {{ $comment->author_type === 'admin' ? 'text-green-700' : 'text-slate-900' }}">{{ $comment->nama }}</p>
                <span class="text-xs text-gray-900">•</span>
                <p class="text-xs text-gray-900">{{ optional($comment->tanggal)->format('d M Y, H:i') }}</p>
            </div>
            <div class="text-base text-slate-900 leading-relaxed whitespace-pre-line">{{ $comment->isi }}</div>
            
            {{-- Action Buttons --}}
            <div class="flex items-center gap-4 mt-2 pt-0">
                <button type="button" 
                    class="flex items-center gap-1.5 text-sm font-bold {{ $comment->is_liked_by_me ? 'text-green-700' : 'text-slate-900' }} hover:text-green-700 transition-colors group"
                    data-action="like-comment" 
                    data-id="{{ $comment->id }}">
                    
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        class="h-5 w-5 {{ $comment->is_liked_by_me ? 'hidden' : 'text-gray-400 group-hover:text-green-700' }}" 
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" data-icon="outline">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>

                    <svg xmlns="http://www.w3.org/2000/svg" 
                        class="h-5 w-5 {{ $comment->is_liked_by_me ? 'text-green-700 fill-current' : 'hidden' }}" 
                        viewBox="0 0 20 20" fill="currentColor" data-icon="solid">
                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                    </svg>

                    <span class="like-count">{{ $comment->total_likes > 0 ? $comment->total_likes : '' }}</span>
                    <span>Suka</span>
                </button>

                @if($level < 4) 
                <button type="button" 
                    class="flex items-center gap-1.5 text-sm font-bold text-slate-900 hover:text-green-700 transition-colors group"
                    data-action="reply-comment" 
                    data-id="{{ $comment->id }}" 
                    data-thread-id="{{ $comment->thread_id }}"
                    data-name="{{ $comment->nama }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                    </svg>
                    <span>Balas</span>
                </button>
                @endif
            </div>

            {{-- Nested Replies (Recursive) --}}
            @php
                $children = $allComments->where('parent_id', $comment->id)->sortBy('tanggal');
                $childCount = $children->count();
            @endphp
            
            @if($childCount > 0)
                <div class="mt-4">
                    {{-- Toggle Button for replies --}}
                    @php
                        $shouldHide = ($level === 1 && $childCount > 3) || ($level >= 2 && $childCount > 0);
                    @endphp
                    @if($shouldHide)
                        <button type="button" 
                            class="flex items-center gap-2 text-sm font-bold text-green-700 hover:text-green-800 transition-colors mb-4"
                            data-action="toggle-replies" 
                            data-target="replies-{{ $comment->id }}"
                            data-count="{{ $childCount }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                            <span data-label>Lihat {{ $childCount }} Balasan</span>
                        </button>
                    @endif

                    <div id="replies-{{ $comment->id }}" class="{{ $shouldHide ? 'hidden' : '' }} space-y-4">
                        @foreach($children as $child)
                            <x-website.components.content.comment-item :comment="$child" :allComments="$allComments" :level="$level + 1" />
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
