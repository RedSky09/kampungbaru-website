<?php

namespace App\Helpers;

use App\Models\Submission;
use Illuminate\Support\Str;

class SubmissionCode
{
    public static function generate(): string
    {
        do {
            $code = 'KB-' . strtoupper(Str::random(4)) . '-' . random_int(1000, 9999);
        } 
        while (Submission::where('code', $code)->exists());

        return $code;
    }
}