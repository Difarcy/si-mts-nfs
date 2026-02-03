@php
    $item = $comments->firstWhere('id', $parentId);
    $isAdmin = ($item->author_type ?? 'visitor') === 'admin';
    $timeText = optional($item->tanggal)->format('d M Y, H:i');
    $liked = (bool) ($likedMap[$item->id] ?? false);
    $level = (int) ($level ?? 1);

    // Find children
    $children = $comments->where('parent_id', $item->id)->sortBy('tanggal');
    $childCount = $children->count();
@endphp

@include('admin.partials.interaction.comments.thread-item', [
    'item' => $item,
    'likeCount' => $likeCounts[$item->id] ?? 0,
    'liked' => $liked,
    'level' => $level
])

{{-- Load children with toggle if at root and many replies --}}
@if($childCount > 0)
    <div class="mt-0">
        @if($level === 1 && $childCount > 3)
            <div class="py-2 ml-14">
                <button type="button" 
                    class="flex items-center gap-2 text-xs font-bold text-green-700 hover:text-green-800 transition-colors"
                    data-action="toggle-admin-replies"
                    data-target="admin-replies-{{ $item->id }}"
                    data-count="{{ $childCount }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" data-icon-chevron>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                    <span data-label>Lihat {{ $childCount }} Balasan</span>
                </button>
            </div>
        @endif

        <div id="admin-replies-{{ $item->id }}" class="{{ ($level === 1 && $childCount > 3) ? 'hidden' : '' }}">
            @foreach($children as $child)
                @include('admin.partials.interaction.comments.recursive-thread', [
                    'comments' => $comments,
                    'parentId' => $child->id,
                    'level' => $level + 1,
                    'likeCounts' => $likeCounts,
                    'likedMap' => $likedMap
                ])
            @endforeach
        </div>
    </div>
@endif
