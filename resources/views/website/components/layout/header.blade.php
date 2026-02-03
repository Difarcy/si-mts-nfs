<header class="bg-green-600 shadow-md">
    <div class="container mx-auto px-4 py-3 md:py-4 flex justify-between items-center">
        <!-- Logo & Nama Sekolah -->
        <a href="/" class="flex items-center space-x-2 md:space-x-4">
            <img src="{{ $websiteLogo }}" alt="Logo MTs Nurul Falaah Soreang"
                class="h-10 w-auto md:h-16 object-contain">
            <div class="flex flex-col text-white font-bold leading-none tracking-wide drop-shadow-md font-roboto-slab">
                <span class="text-sm md:text-2xl">MTs Nurul Falaah</span>
                <span class="text-sm md:text-2xl">Soreang</span>
            </div>
        </a>

        <!-- Navbar Inside Header -->
        <div class="flex items-center">
            @include('website.components.layout.navbar')
        </div>
    </div>
</header>