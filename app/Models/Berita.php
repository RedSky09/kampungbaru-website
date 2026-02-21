<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Berita extends Model
{
    protected $table = 'beritas';

    protected $fillable = [
        'judul',
        'slug',
        'thumbnail',
        'ringkasan',
        'konten',
        'is_published',
    ];

    protected static function booted()
    {
        static::creating(function ($berita) {
            if (! $berita->ringkasan && $berita->konten) {
                $berita->ringkasan = Str::limit(
                    strip_tags($berita->konten),
                    100
                );
            }
        });
    }
    public function getThumbnailUrlAttribute(): string
    {
        if ($this->thumbnail) {
            if (Storage::disk('public')->exists($this->thumbnail)) {
                return asset('storage/' . $this->thumbnail);
            }
        }
        return asset('images/berita.jpeg'); // Fallback
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
