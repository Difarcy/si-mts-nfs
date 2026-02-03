@extends('website.layouts.main')

@section('title', 'Beranda')

@section('hero')
    <section class="w-full relative overflow-hidden">
        <div class="relative group h-64 sm:h-112 md:h-128 lg:h-144 w-full overflow-hidden flex" data-banner-slider>
            @include('website.pages.home.sections.banner')
            @include('website.pages.home.sections.hero-content')
        </div>
    </section>
    @include('website.pages.home.sections.info-ticker')
@endsection

@section('content')
    <div class="space-y-4 sm:space-y-6">
        @include('website.pages.home.sections.highlight-news')
        @include('website.pages.home.sections.latest-news')
        @include('website.pages.home.sections.promosi-banner')
        @include('website.pages.home.sections.latest-articles')
        @include('website.pages.home.sections.student-achievement')
        @include('website.pages.home.sections.activity-photo')
        @include('website.pages.home.sections.activity-video')
    </div>
@endsection

@section('sidebar')
    @include('website.components.content.headmaster-greeting', ['kepalaMadrasah' => $kepalaMadrasah ?? null])
    @include('website.components.content.announcement-widget', ['infoTerkini' => $infoTerkini ?? collect()])
    @include('website.components.content.agenda-widget', ['agendaTerbaru' => $agendaTerbaru ?? collect()])
    @include('website.components.content.social-media-widget')
    @include('website.components.content.category-widget', ['postCategories' => $postCategories ?? []])
    @include('website.components.content.calendar-widget')
@endsection
