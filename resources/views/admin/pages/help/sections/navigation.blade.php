<x-admin.ui.card>
    <x-slot:header>
        <h2 class="text-[13px] sm:text-base font-bold text-black tracking-widest">Navigasi Cepat</h2>
    </x-slot:header>
    <div class="p-6">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3">
            @php
                $navs = [
                    ['id' => 'dashboard', 'label' => 'Dashboard', 'hover' => 'hover:bg-blue-50 hover:text-blue-700 hover:border-blue-400'],
                    ['id' => 'konten', 'label' => 'Konten', 'hover' => 'hover:bg-green-50 hover:text-green-700 hover:border-green-400'],
                    ['id' => 'media', 'label' => 'Media', 'hover' => 'hover:bg-pink-50 hover:text-pink-700 hover:border-pink-400'],
                    ['id' => 'interaksi', 'label' => 'Interaksi', 'hover' => 'hover:bg-purple-50 hover:text-purple-700 hover:border-purple-400'],
                    ['id' => 'pengaturan', 'label' => 'Pengaturan', 'hover' => 'hover:bg-gray-100 hover:text-black hover:border-black'],
                    ['id' => 'tips', 'label' => 'Tips & Trik', 'hover' => 'hover:bg-amber-50 hover:text-amber-700 hover:border-amber-400'],
                ];
            @endphp
            @foreach($navs as $nav)
                <a href="#{{ $nav['id'] }}"
                    class="px-4 py-2 bg-white border border-black text-sm font-bold text-black text-center transition-all tracking-tighter rounded {{ $nav['hover'] }}">
                    {{ $nav['label'] }}
                </a>
            @endforeach
        </div>
    </div>
</x-admin.ui.card>
