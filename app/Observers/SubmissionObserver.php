<?php

namespace App\Observers;

use App\Models\Submission;
use App\Services\WhatsAppService;
use Illuminate\Support\Facades\Log;

class SubmissionObserver
{
    public function updated(Submission $submission): void
    {
        // only if status berubah
        if (!$submission->wasChanged('status')) {
            return;
        }

        Log::info('Submission status changed', [
            'id' => $submission->id,
            'code' => $submission->code,
            'old_status' => $submission->getOriginal('status'),
            'new_status' => $submission->status,
        ]);

        // Kirim notifikasi WhatsApp
        WhatsAppService::sendStatus($submission);
    }
}