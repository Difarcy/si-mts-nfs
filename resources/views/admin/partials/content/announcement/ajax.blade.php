<div id="announcement-list-container">
    @include('admin.partials.content.announcement.list', ['pengumuman' => $pengumuman])
</div>

<div id="announcement-pagination-container">
    @include('admin.partials.content.announcement.pagination', ['pengumuman' => $pengumuman])
</div>