<section id="telusuri" class="py-12 md:py-16 bg-white">
    <div class="max-w-7xl mx-auto px-6">

        {{-- Header --}}
        <div 
            class="flex flex-col lg:flex-row 
                   items-center lg:items-start 
                   justify-between 
                   text-center lg:text-left 
                   mb-12
                   transition-all duration-700">

            <h2 class="text-3xl md:text-4xl font-bold">
                Telusuri Kami
            </h2>

            <p class="max-w-xl text-gray-600 mt-4 lg:mt-0 lg:text-right">
                Informasi penting Kelurahan Kampung Baru yang mudah diakses secara online
                melalui kumpulan layanan di bawah ini.
            </p>
        </div>

        {{-- Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @php
                $items = [
                    [
                        'title' => 'Pemerintah',
                        'desc' => 'Informasi mengenai struktur dan tugas perangkat pemerintahan',
                        'icon' => 'fa-users',
                        'url' => '/pemerintah'
                    ],
                    [
                        'title' => 'Berita',
                        'desc' => 'Berita dan informasi terbaru di Kelurahan Kampung Baru',
                        'icon' => 'fa-newspaper',
                        'url' => '/berita'
                    ],
                    [
                        'title' => 'Layanan',
                        'desc' => 'Informasi layanan administrasi dan pelayanan publik',
                        'icon' => 'fa-envelope',
                        'url' => '/layanan'
                    ],
                ];
            @endphp

            @foreach ($items as $item)
            <a href="{{ $item['url'] }}"
               class="group border border-gray-200 bg-white
                      rounded-2xl p-6
                      shadow-sm
                      transition-all duration-500 ease-out
                      hover:-translate-y-2
                      hover:shadow-2xl
                      hover:bg-[#00adb5]
                      hover:border-[#00adb5]">
            
                {{-- Icon --}}
                <div class="text-[#00adb5] 
                text-3xl mb-6
                transition-colors duration-300
                group-hover:text-white">
                
                <i class="fa-solid {{ $item['icon'] }}
                transition-transform duration-300
                group-hover:scale-110"></i>
                </div>
            
                {{-- Title --}}
                <h3 class="text-lg font-bold mb-3 
                           text-gray-800 
                           transition-colors duration-500
                           group-hover:text-white">
                    {{ $item['title'] }}
                </h3>
            
                {{-- Description --}}
                <p class="text-gray-600 mb-6 text-sm leading-relaxed 
                          transition-colors duration-500
                          group-hover:text-white">
                    {{ $item['desc'] }}
                </p>
            
                {{-- Footer --}}
                <div class="flex items-center justify-between 
                            font-semibold text-[#00adb5] 
                            transition-colors duration-500
                            group-hover:text-white">
                    <span>Lihat Detail</span>
                    <i class="fa-solid fa-arrow-right 
                               transition-all duration-500 
                               group-hover:translate-x-2"></i>
                </div>
            </a>
            @endforeach

        </div>
    </div>
</section>
