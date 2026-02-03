@extends('website.layouts.full')

@section('title', 'SPMB/PPDB')

@section('hero')
    {{-- Hero Section --}}
    @include('website.pages.spmb.sections.hero')
@endsection

@section('content')
    <!-- Wrapper -->
    <div class="min-h-screen -mx-4 -mt-8 sm:-mt-12">

        {{-- Info Cards Section --}}
        @include('website.pages.spmb.sections.info-cards')

        {{-- Keunggulan Section --}}
        @include('website.pages.spmb.sections.advantages')

        {{-- Fasilitas Section --}}
        @include('website.pages.spmb.sections.facilities')

        {{-- Ekstrakurikuler Section --}}
        @include('website.pages.spmb.sections.extracurriculars')

        {{-- Siswa Berprestasi Section --}}
        @include('website.pages.spmb.sections.achievements')

        {{-- Syarat Pendaftaran Section --}}
        @include('website.pages.spmb.sections.requirements')

        {{-- Jadwal Pendaftaran Section --}}
        @include('website.pages.spmb.sections.schedule')

        {{-- Contact CTA Section --}}
        @include('website.pages.spmb.sections.contact')

    </div>
@endsection