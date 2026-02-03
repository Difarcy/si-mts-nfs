<div id="news-list-container">
    @include('admin.partials.content.news.list', ['berita' => $berita])
</div>

<div id="news-pagination-container">
    @include('admin.partials.content.news.pagination', ['berita' => $berita])
</div>

