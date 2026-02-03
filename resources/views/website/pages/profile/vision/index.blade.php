@extends('website.layouts.main')

@section('title', 'Visi, Misi, dan Tujuan')

@section('content')
    <div class="pt-4 sm:pt-6 space-y-6">
        <x-website.components.layout.breadcrumb :items="[['label' => 'PROFIL'], ['label' => 'VISI, MISI, TUJUAN']]" />
        <x-website.components.layout.page-title title="Visi, Misi, dan Tujuan" />

        <div class="space-y-6">
            <!-- Visi -->
            <div class="py-6 sm:py-8">
                <h3
                    class="text-[12px] sm:text-[16px] font-bold text-green-700 mb-6 text-center font-roboto-slab uppercase tracking-widest">
                    - VISI -
                </h3>

                @if($visiMisiTujuan?->visi)
                    <div
                        class="prose prose-sm sm:prose-base max-w-none text-black leading-relaxed text-justify font-inter">
                        {!! $visiMisiTujuan->visi !!}
                    </div>
                @else
                    <div class="py-16 flex flex-col items-center justify-center text-center">
                        <p class="text-[11px] sm:text-base font-semibold text-slate-900 tracking-wider">
                            Belum Ada Visi
                        </p>
                    </div>
                @endif
            </div>

            <!-- Misi -->
            <div class="py-6 sm:py-8">
                <h3
                    class="text-[12px] sm:text-[16px] font-bold text-green-700 mb-6 text-center font-roboto-slab uppercase tracking-widest">
                    - MISI -
                </h3>

                @if($visiMisiTujuan?->misi)
                    <div class="prose prose-sm sm:prose-base max-w-none text-black leading-relaxed text-justify font-inter">
                        {!! $visiMisiTujuan->misi !!}
                    </div>
                @else
                    <div class="py-16 flex flex-col items-center justify-center text-center">
                        <p class="text-[11px] sm:text-base font-semibold text-slate-900 tracking-wider">
                            Belum Ada Misi
                        </p>
                    </div>
                @endif
            </div>

            <!-- Tujuan -->
            <div class="py-6 sm:py-8">
                <h3
                    class="text-[12px] sm:text-[16px] font-bold text-green-700 mb-6 text-center font-roboto-slab uppercase tracking-widest">
                    - TUJUAN -
                </h3>

                @if($visiMisiTujuan?->tujuan)
                    <div class="prose prose-sm sm:prose-base max-w-none text-black leading-relaxed text-justify font-inter">
                        {!! $visiMisiTujuan->tujuan !!}
                    </div>
                @else
                    <div class="py-16 flex flex-col items-center justify-center text-center">
                        <p class="text-[11px] sm:text-base font-semibold text-slate-900 tracking-wider">
                            Belum Ada Tujuan
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('sidebar')
    {{-- Offset untuk menyesuaikan dengan Page Title di sebelah kiri (melompati tinggi breadcrumb) --}}
    <div class="space-y-6 pt-4 sm:pt-6 lg:pt-[52px]">
        @include('website.components.content.news-widget')
        @include('website.components.content.article-widget')
    </div>
@endsection
