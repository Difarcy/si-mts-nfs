<div id="achievement-list-container">
    @include('admin.partials.content.achievements.list', ['prestasi' => $prestasi])
</div>

<div id="achievement-pagination-container">
    @include('admin.partials.content.achievements.pagination', ['prestasi' => $prestasi])
</div>