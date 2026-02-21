<div class="bg-white border rounded-xl overflow-hidden
            shadow-sm hover:shadow-lg transition
            flex flex-col">

    {{-- Thumbnail --}}
    <img
    src="{{ $image }}"
    alt="{{ $title }}"
    class="h-48 w-full object-cover">
    <div class="p-5 flex flex-col h-full">

        {{-- Judul --}}
        <h3 class="font-bold text-lg mb-2">
            {{ $title ?? 'Judul Berita' }}
        </h3>

        {{-- Excerpt --}}
        <p class="font-medium text-sm text-gray-600 mb-4">
            {{ $excerpt ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.' }}
        </p>

        {{-- Tanggal --}}
        <div class="font-medium flex items-center gap-2 text-sm text-gray-500 mb-4">
            <i class="fa-solid fa-calendar"></i>
            <span>{{ $date ?? '25 Januari 2026' }}</span>
        </div>

        {{-- CTA --}}
        <a href="{{ $url ?? '#' }}"
           class="mt-auto inline-flex items-center gap-2
                  bg-[#00adb5] hover:bg-teal-600
                  text-white px-4 py-2 rounded-lg
                  text-sm font-semibold transition w-fit">
            Baca Selengkapnya
            <i class="fa-solid fa-arrow-right text-xs"></i>
        </a>
    </div>
</div>
