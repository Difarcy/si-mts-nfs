@extends('admin.layouts.admin')

@section('title', 'Foto')

@section('content')
    <div id="photo-gallery-container" class="flex flex-col gap-3" 
         x-data="{ hasData: {{ $photos->count() > 0 ? 'true' : 'false' }} }"
         data-route-index="{{ route('admin.media.foto.index') }}"
         data-has-more-pages="{{ $photos->hasMorePages() ? 'true' : 'false' }}">
        {{-- Header --}}
        <x-admin.ui.page-header title="Foto" subtitle="Upload dan kelola dokumentasi foto sekolah">
            <x-slot:actions>
                <template x-if="hasData">
                    <x-admin.form.button variant="add" type="button" class="sm:w-24 border border-black"
                        x-on:click="$dispatch('open-modal', { name: 'upload-photo' })">
                        <x-slot:icon>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                                </path>
                            </svg>
                        </x-slot:icon>
                        Tambah
                    </x-admin.form.button>
                </template>
            </x-slot:actions>
        </x-admin.ui.page-header>

        {{-- Main Content Area --}}
        <x-admin.ui.card>
            <div class="overflow-y-auto" style="height: clamp(520px, 70vh, 640px);" id="photo-scroll-container">
                <div id="photo-content" class="min-h-full flex flex-col">
                    @include('admin.partials.media.photo.list')
                </div>
                
                {{-- Load More Spinner/Button Container --}}
                <div id="photo-load-more-container" class="py-4 text-center hidden">
                     <x-admin.form.button variant="secondary" type="button" id="btn-load-more" class="mx-auto">
                        Muat Lebih Banyak
                    </x-admin.form.button>
                </div>
            </div>

            <x-slot:footer>
                <div class="text-xs text-gray-500" id="photo-count-info">
                    Menampilkan {{ $photos->count() }} dari {{ $photos->total() }} foto
                </div>
            </x-slot:footer>
        </x-admin.ui.card>

        {{-- Modal Upload Foto --}}
        <x-admin.ui.modal name="upload-photo" title="Upload Foto Baru" maxWidth="2xl">
            <form action="{{ route('admin.media.foto.store') }}" method="POST" enctype="multipart/form-data" data-no-unsaved-warning>
                @csrf
                <!-- Upload Area -->
                <x-admin.form.upload-image name="files" :multiple="true" :required="true" label="Pilih Foto"
                    helper-text="Format jpeg, png, jpg. Maks 10MB per file. Maks 16 file sekaligus." max-files="16" />

                <div class="mt-8 flex justify-end gap-3">
                    <x-admin.form.button variant="secondary" x-on:click="$dispatch('close-modal', { name: 'upload-photo' })"
                        type="button" class="sm:w-24">
                        Batal
                    </x-admin.form.button>
                    <x-admin.form.button variant="add" type="submit" class="sm:w-24">
                        Upload
                    </x-admin.form.button>
                </div>
            </form>
        </x-admin.ui.modal>
    </div>
@endsection
