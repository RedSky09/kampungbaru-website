@extends('layouts.app')

@section('title', $berita->judul)

@section('content')
<article class="max-w-4xl mx-auto px-4 sm:px-6 py-8 sm:py-10">

    {{-- Breadcrumb --}}
    <nav class="text-xs sm:text-sm text-gray-500 mb-5 flex items-center gap-1.5 flex-wrap">
        <a href="{{ route('home') }}" class="hover:text-[#00adb5] transition">Beranda</a>
        <i class="fa-solid fa-chevron-right text-xs"></i>
        <a href="{{ route('berita.index') }}" class="hover:text-[#00adb5] transition">Berita</a>
        <i class="fa-solid fa-chevron-right text-xs"></i>
        <span class="text-gray-400 truncate max-w-[160px] sm:max-w-xs">{{ $berita->judul }}</span>
    </nav>

    {{-- Judul --}}
    <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold leading-tight mb-3">
        {{ $berita->judul }}
    </h1>

    {{-- Tanggal --}}
    <p class="text-xs sm:text-sm text-gray-500 mb-4 flex items-center gap-1.5">
        <i class="fa-regular fa-calendar"></i>
        Diterbitkan pada
        <time datetime="{{ $berita->created_at->format('Y-m-d') }}">
            {{ $berita->created_at->translatedFormat('d F Y') }}
        </time>
    </p>

    {{-- Garis pemisah --}}
    <hr class="mb-6 border-gray-200">

    {{-- Kotak konten --}}
    <div class="border border-gray-200 rounded-xl p-4 sm:p-5 md:p-6 bg-white">

        {{-- Thumbnail --}}
        @if ($berita->thumbnail)
            <img
                src="{{ asset('storage/' . $berita->thumbnail) }}"
                alt="{{ $berita->judul }}"
                class="w-full rounded-lg mb-6 object-cover max-h-[400px]"
            >
        @endif

        {{-- Isi berita --}}
        <div class="prose prose-sm sm:prose-base lg:prose-lg max-w-none
            prose-headings:font-bold prose-headings:text-gray-900
            prose-p:text-gray-700 prose-p:leading-relaxed
            prose-strong:text-gray-900
            prose-img:rounded-lg">
            {!! $berita->konten !!}
        </div>

    </div>

    {{-- Tombol Kembali --}}
    <div class="mt-6 sm:mt-8">
        <a
            href="{{ route('berita.index') }}"
            class="inline-flex items-center gap-2 text-sm font-semibold text-[#00adb5] hover:text-teal-700 transition"
        >
            <i class="fa-solid fa-arrow-left"></i>
            Kembali ke Berita
        </a>
    </div>

</article>
@endsection