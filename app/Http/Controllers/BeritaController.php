<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::where('is_published', true)
            ->latest()
            ->paginate(6);

        return view('pages.berita.index', compact('beritas'));
    }

    public function show(string $slug)
    {
        $berita = Cache::remember(
            "berita.{$slug}",
            300,
            fn () => Berita::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail()
        );
        $metaTitle = $berita->judul;
        $metaDescription = $berita->ringkasan;
        $metaImage = $berita->thumbnail_url;
        
        return view('pages.berita.show', compact(
            'berita',
            'metaTitle',
            'metaDescription',
            'metaImage'
        ));
    }
}