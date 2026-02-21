@extends('layouts.app')

@section('title', 'Pemerintah Kelurahan Kampung Baru')

@section('content')

    <section class="max-w-7xl mx-auto px-4 sm:px-6 pt-10 sm:pt-14 pb-8 sm:pb-10">
        <h1 class="text-2xl sm:text-3xl font-bold text-[#00adb5] mb-3">
            Pemerintah Kelurahan Kampung Baru
        </h1>
        <p class="text-sm sm:text-base text-gray-600 max-w-2xl">
            Informasi mengenai visi, misi, dan perangkat Kelurahan Kampung Baru
        </p>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 pb-12 sm:pb-16 space-y-8 sm:space-y-10">

        {{-- VISI --}}
        <div>
            <h2 class="text-lg sm:text-xl font-bold mb-3 text-[#00adb5]">
                Visi
            </h2>
            <div class="border-2 border-[#00adb5] rounded-xl p-4 sm:p-5 bg-white">
                <p class="text-sm sm:text-base text-gray-700 leading-relaxed font-medium">
                    "Terwujudnya pembangunan dan pelayanan publik yang berkualitas serta meningkatkan pelayanan dasar di bidang pendidikan dan kesehatan serta terbukanya kesempatan kerja yang luas. Dan juga terwujudnya Kota Parepare sebagai kawasan strategis nasional yang unggul dibidang perdagangan dan jasa."
                </p>
            </div>
        </div>

        {{-- MISI --}}
        <div>
            <h2 class="text-lg sm:text-xl font-bold mb-3 text-[#00adb5]">
                Misi
            </h2>
            <div class="border-2 border-[#00adb5] rounded-xl p-4 sm:p-5 bg-white">
                <ol class="space-y-2 sm:space-y-3 text-sm sm:text-base text-gray-700 list-decimal list-inside">
                    <li>Mewujudkan Kota Parepare yang berakhlaq dengan mengedepankan harmonisasi dan toleransi antar umat beragama</li>
                    <li>Mewujudkan tata kelola pemerintahan yang pintar (Smart Governance)</li>
                    <li>Mewujudkan pelayanan kesehatan dan pendidikan dasar yang bermutu</li>
                    <li>Mewujudkan iklim usaha yang sehat dan peluang investasi yang berkeadilan</li>
                    <li>Mengembangkan industri berbasis usaha mikro kecil dan menengah</li>
                    <li>Menyediakan kebutuhan sarana dan prasarana bagi petani dan nelayan</li>
                    <li>Terwujudnya rumah layak huni yang terpadu</li>
                    <li>Mewujudkan pemerataan pembangunan infrastruktur publik yang inklusif</li>
                    <li>Mengembangkan infrastruktur pengendalian banjir, pemenuhan akses air minum yang aman serta jaringan transportasi dan fasilitas antar moda dalam mendukung perkeretaapian Parepare-Makassar</li>
                    <li>Mewujudkan Kota Parepare sebagai Kota destinasi</li>
                </ol>
            </div>
        </div>

    </section>

    {{-- PERANGKAT KELURAHAN --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 pb-16 sm:pb-24">

        <div class="mb-6 sm:mb-8">
            <h2 class="text-xl sm:text-2xl font-bold text-[#00adb5] mb-2">
                Perangkat Kelurahan
            </h2>
            <p class="text-sm sm:text-base text-gray-600">
                Kenali perangkat Kelurahan Kampung Baru
            </p>
        </div>

        {{-- Grid: 2 kolom di mobile, 4 kolom di desktop --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 sm:gap-6">

            @foreach ($officials as $official)
            <div class="bg-white rounded-xl shadow-sm border hover:shadow-lg transition overflow-hidden">
                <img
                    src="{{ $official->photo
                        ? asset('storage/' . $official->photo)
                        : 'https://ui-avatars.com/api/?name=' . urlencode($official->name) . '&background=00adb5&color=fff&size=200' }}"
                    alt="Foto {{ $official->name }}"
                    class="w-full h-32 sm:h-40 object-cover"
                >
                <div class="p-3 sm:p-4 text-center">
                    <h3 class="font-bold text-sm sm:text-base text-gray-800 leading-tight">
                        {{ $official->name }}
                    </h3>
                    <p class="text-xs sm:text-sm text-gray-500 mt-1">
                        {{ $official->position }}
                    </p>
                </div>
            </div>
            @endforeach

        </div>

    </section>

@endsection