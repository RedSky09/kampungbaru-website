<section id="statistik" class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-6">

        <div data-reveal
             class="overflow-hidden rounded-2xl shadow-lg
                    grid grid-cols-1 md:grid-cols-4">

            {{-- Kiri --}}
            <div class="bg-[#00adb5] text-white px-8 py-12 flex flex-col justify-center text-center md:text-left">
                <h3 class="text-xl md:text-2xl font-bold mb-2">
                    Statistik Ringkas
                </h3>
                <p class="font-medium text-sm opacity-90">
                    Perkembangan Kelurahan Kampung Baru
                </p>
            </div>

            {{-- Kanan --}}
            <div class="md:col-span-3 bg-[#393e46] text-white
                        grid grid-cols-1 sm:grid-cols-3">

                {{-- Luas Wilayah --}}
                <div data-reveal style="transition-delay: 100ms"
                     class="flex flex-col items-center justify-center px-6 py-12">
                    <span class="text-3xl md:text-4xl font-bold counter-decimal"
                          data-target="0.46" data-decimals="2">0</span>
                    <span class="font-medium text-sm opacity-80 mt-2">
                        Luas Wilayah (Ha)
                    </span>
                </div>

                {{-- RT --}}
                <div data-reveal style="transition-delay: 200ms"
                     class="flex flex-col items-center justify-center px-6 py-12">
                    <span class="text-3xl md:text-4xl font-bold counter"
                          data-target="16">0</span>
                    <span class="font-medium text-sm opacity-80 mt-2">
                        Jumlah RT (4 RW / 16 RT)
                    </span>
                </div>

                {{-- Penduduk --}}
                <div data-reveal style="transition-delay: 300ms"
                     class="flex flex-col items-center justify-center px-6 py-12">
                    <span class="text-3xl md:text-4xl font-bold counter"
                          data-target="5709">0</span>
                    <span class="font-medium text-sm opacity-80 mt-2">
                        Jumlah Penduduk
                    </span>
                </div>

            </div>

        </div>

        {{-- Sumber --}}
        <p class="mt-5 text-center md:text-right text-xs text-gray-500 italic">
            Data diambil dari 
            <a href="https://pareparekota.go.id/index.php/gis/"
               class="underline hover:text-[#00adb5]"
               target="_blank" rel="noopener">
               GIS resmi Website Kota Parepare
            </a>
        </p>

    </div>
</section>
