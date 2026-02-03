<div id="agenda-list-container">
    @include('admin.partials.content.agenda.list', ['agenda' => $agenda])
</div>

<div id="agenda-pagination-container">
    @include('admin.partials.content.agenda.pagination', ['agenda' => $agenda])
</div>