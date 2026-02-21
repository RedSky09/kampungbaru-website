<?php

namespace App\Services;

use App\Models\Submission;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    public static function sendStatus(Submission $submission): void
    {
        try {
            $message = self::message($submission);
            $phone = self::normalizePhone($submission->phone);

            Log::info('Sending WhatsApp notification', [
                'phone' => $phone,
                'code' => $submission->code,
                'status' => $submission->status,
            ]);

            /** @var \Illuminate\Http\Client\Response $response */
            $response = Http::withHeaders([
                'Authorization' => config('services.fonnte.token'),
            ])->post('https://api.fonnte.com/send', [
                'target'  => $phone,
                'message' => $message,
            ]);

            // Alternative: gunakan successful() dan status() yang lebih compatible
            if (!$response->successful()) {
                Log::error('WhatsApp sending failed', [
                    'response' => $response->body(),
                    'status_code' => $response->status(),
                ]);
            } else {
                Log::info('WhatsApp sent successfully', [
                    'response' => $response->json(),
                ]);
            }

        } catch (\Exception $e) {
            Log::error('WhatsApp service error', [
                'error' => $e->getMessage(),
                'submission_id' => $submission->id,
            ]);
        }
    }

    protected static function message(Submission $s): string
    {
        $statusText = match($s->status) {
            'pending' => 'MENUNGGU',
            'approved' => 'DISETUJUI',
            'rejected' => 'DITOLAK',
            'finished' => 'SELESAI',
            default => strtoupper($s->status),
        };
        
        $text = "*Status Pengajuan Layanan Kampung Baru*\n\n";
        $text .= "Kode: *{$s->code}*\n";
        $text .= "Jenis: {$s->service_type}\n";
        $text .= "Status: *{$statusText}*\n";

        if ($s->status === 'rejected' && $s->rejection_reason) {
            $text .= "\nAlasan Penolakan:\n{$s->rejection_reason}";
        }

        if ($s->status === 'finished') {
            $text .= "\n\n✅ Pengajuan Anda telah selesai diproses.";
        }

        if ($s->status === 'approved') {
            $text .= "\n\n✅ Pengajuan Anda telah disetujui dan sedang diproses.";
        }

        return $text;
    }

    protected static function normalizePhone(string $phone): string
    {
        // Hapus semua karakter non-digit
        $phone = preg_replace('/[^0-9]/', '', $phone);

        // 08xxxx → 628xxxx
        if (str_starts_with($phone, '08')) {
            return '62' . substr($phone, 1);
        }

        // Jika sudah 628xxx, return as is
        if (str_starts_with($phone, '62')) {
            return $phone;
        }

        // Jika 8xxx (tanpa 0), tambahkan 62
        if (str_starts_with($phone, '8')) {
            return '62' . $phone;
        }

        return $phone;
    }
}