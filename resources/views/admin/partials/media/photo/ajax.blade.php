@include('admin.partials.media.photo.list')

<div class="mt-4 px-4 pb-4" id="photo-pagination">
    @include('admin.partials.media.photo.pagination')
</div>

<div id="pagination-meta" data-has-more="{{ $photos->hasMorePages() ? 'true' : 'false' }}" class="hidden"></div>