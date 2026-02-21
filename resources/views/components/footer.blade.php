<footer class="bg-[#1f2933] text-white pt-16 md:pt-20 pb-10">
    <div class="max-w-7xl mx-auto px-6">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start">

            {{-- KIRI --}}
            <div data-reveal class="text-center md:text-left">
                <h3 class="text-xl md:text-2xl font-bold mb-2">
                    Kelurahan Kampung Baru
                </h3>

                <p class="text-[#00adb5] text-sm mb-6">
                    Kec. Bacukiki Barat, Kota Parepare, Sulawesi Selatan
                </p>

                <p class="font-semibold mb-4">
                    Ikuti Media Sosial Kami:
                </p>

                <div class="flex justify-center md:justify-start gap-4">
                    <a href="https://www.instagram.com/humas_kampung_baru?utm_source=ig_web_button_share_sheet"
                       target="_blank"
                       rel="noopener"
                       class="w-10 h-10 flex items-center justify-center
                              rounded-full bg-white/10 hover:bg-[#00adb5]
                              transition duration-300">
                        <i class="fa-brands fa-instagram"></i>
                    </a>

                    <a href="https://www.youtube.com/@Humas_Kampungbaru77"
                       target="_blank"
                       rel="noopener"
                       class="w-10 h-10 flex items-center justify-center
                              rounded-full bg-white/10 hover:bg-[#00adb5]
                              transition duration-300">
                        <i class="fa-brands fa-youtube"></i>
                    </a>
                </div>
            </div>

            {{-- KANAN --}}
            <div data-reveal style="transition-delay: 150ms"
                 class="text-center md:text-left">
                <h3 class="text-xl md:text-2xl font-bold mb-4">
                    Lokasi
                </h3>

                <div class="rounded-2xl overflow-hidden border border-white/10 shadow-lg">
                    <iframe
                        src="https://www.google.com/maps?q=Kelurahan+Kampung+Baru,+Parepare,+Sulawesi+Selatan&output=embed"
                        class="w-full h-64 md:h-72 border-0"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

        </div>

        {{-- COPYRIGHT --}}
        <div class="border-t border-white/10 mt-14 pt-6 text-center text-sm text-gray-400 space-y-1">
            <p>
                © {{ date('Y') }} Kelurahan Kampung Baru, Kota Parepare
            </p>
            <p class="text-gray-500">
                Dikembangkan oleh Tim KKNT 115 Universitas Hasanuddin
            </p>
        </div>

    </div>
</footer>
