<div id="article-list-container">
    @include('admin.partials.content.article.list', ['artikel' => $artikel])
</div>

<div id="article-pagination-container">
    @include('admin.partials.content.article.pagination', ['artikel' => $artikel])
</div>
