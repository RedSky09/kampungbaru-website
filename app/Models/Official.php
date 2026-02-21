<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Official extends Model
{
    protected $fillable = [
        'name',
        'position',
        'photo',
    ];
     protected static function booted()
    {
        static::deleting(function ($official) {
            if ($official->photo && Storage::disk('public')->exists($official->photo)) {
                Storage::disk('public')->delete($official->photo);
            }
        });
    }
}