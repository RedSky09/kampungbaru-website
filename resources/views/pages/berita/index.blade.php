@extends('layouts.app')

@section('title', 'Berita Kelurahan Kampung Baru')

@section('content')

    {{-- Header Berita --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 pt-10 sm:pt-12 pb-8 sm:pb-10">
        <h1 class="text-2xl sm:text-3xl font-bold text-[#00adb5] mb-2">
            Berita
        </h1>
        <p class="text-sm sm:text-base text-gray-600 max-w-2xl">
            Ikuti perkembangan informasi terbaru yang terjadi di Kelurahan Kampung Baru
        </p>
    </section>

    {{-- List Berita --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 pb-10 sm:pb-14">
        {{-- Grid: 1 kolom mobile, 2 kolom tablet, 3 kolom desktop --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5 sm:gap-8">
            @foreach ($beritas as $berita)
                @include('components.berita-card', [
                    'title' => $berita->judul,
                    'excerpt' => $berita->ringkasan,
                    'date' => $berita->created_at->translatedFormat('d F Y'),
                    'image' => $berita->thumbnail
                        ? asset('storage/' . $berita->thumbnail)
                        : '/images/berita.jpeg',
                    'url' => route('berita.show', $berita->slug),
                ])
            @endforeach
        </div>
    </section>

    {{-- Pagination --}}
    @if ($beritas->hasPages())
        <div class="flex justify-center px-4 pb-16 sm:pb-20">
            {{ $beritas->links() }}
        </div>
    @endif

@endsection