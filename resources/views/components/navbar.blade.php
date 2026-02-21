@props(['active' => null])

<nav x-data="{ open: false }" class="bg-[#222831] text-white sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-center justify-between h-16">

            {{-- Logo --}}
            <div class="flex items-center gap-3">
                <img src="/images/logo.png" alt="Logo" class="h-8 w-auto">
                <span class="font-bold text-lg">
                    Kelurahan Kampung Baru
                </span>
            </div>

            {{-- Desktop Menu --}}
            @php
                $nav = [
                    'home' => ['label' => 'Beranda', 'icon' => 'fa-house'],
                    'pemerintah' => ['label' => 'Pemerintah', 'icon' => 'fa-users'],
                    'berita.index' => ['label' => 'Berita', 'icon' => 'fa-newspaper'],
                    'layanan' => ['label' => 'Layanan', 'icon' => 'fa-envelope'],
                ];
            @endphp

            <div class="hidden md:flex items-center gap-4">
                @foreach ($nav as $route => $item)
                    <a href="{{ route($route) }}"
                       class="flex items-center gap-2 px-3 py-2 rounded-md text-sm font-medium transition
                       {{ request()->routeIs($route.'*')
                       ? 'bg-[#00adb5] text-white'
                       : 'text-white hover:bg-[#00adb5]/90 hover:text-white' }}">
                        <i class="fa-solid {{ $item['icon'] }}"></i>
                        {{ $item['label'] }}
                    </a>
                @endforeach

                {{-- Login --}}
                <a href="/admin/login"
                   class="bg-[#00adb5] hover:bg-teal-600 text-white px-4 py-2 rounded-lg text-sm font-bold flex items-center gap-2">
                    <i class="fa-solid fa-key"></i>
                    Login
                </a>
            </div>

            {{-- Mobile Button --}}
            <button @click="open = !open"
                    class="md:hidden flex items-center justify-center w-10 h-10 rounded-lg hover:bg-[#00adb5]/20 transition">
                <i class="fa-solid" :class="open ? 'fa-xmark' : 'fa-bars'"></i>
            </button>

        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="open"
         x-transition
         class="md:hidden bg-[#1b2228] border-t border-gray-700">
        <div class="px-6 py-4 space-y-2">

            @foreach ($nav as $route => $item)
                <a href="{{ route($route) }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-md text-sm font-medium transition
                   {{ request()->routeIs($route.'*')
                   ? 'bg-[#00adb5] text-white'
                   : 'text-white hover:bg-[#00adb5]/90 hover:text-white' }}">
                    <i class="fa-solid {{ $item['icon'] }}"></i>
                    {{ $item['label'] }}
                </a>
            @endforeach

            {{-- Login --}}
            <a href="/admin/login"
               class="flex items-center justify-center gap-2 mt-3 bg-[#00adb5] hover:bg-teal-600 text-white px-4 py-2 rounded-lg text-sm font-bold">
                <i class="fa-solid fa-key"></i>
                Login
            </a>

        </div>
    </div>
</nav>
