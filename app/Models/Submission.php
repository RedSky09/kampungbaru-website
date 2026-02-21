<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use RuntimeException;

class Submission extends Model
{
    protected $fillable = [
        'code',
        'service_type',
        'name',
        'nik',
        'phone',
        'note',
        'document_path',
        'status',
        'rejection_reason',
        'completed_at',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
        'document_path' => 'array',
    ];

    /**
     * Accessor: Pastikan document_path selalu array
     */
    public function getDocumentPathAttribute($value)
    {
        // Jika null atau empty
        if (empty($value)) {
            return [];
        }

        // Jika sudah array, return as is
        if (is_array($value)) {
            return $value;
        }

        // Jika string JSON, decode
        if (is_string($value)) {
            // Coba decode sebagai JSON array
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return $decoded;
            }
            
            // Jika bukan JSON, anggap sebagai single file path
            // Wrap dalam array
            return [$value];
        }

        return [];
    }

    /**
     * Mutator: Pastikan data disimpan sebagai JSON array
     */
    public function setDocumentPathAttribute($value)
    {
        if (empty($value)) {
            $this->attributes['document_path'] = json_encode([]);
            return;
        }

        if (is_array($value)) {
            $this->attributes['document_path'] = json_encode($value);
            return;
        }

        if (is_string($value)) {
            // Single string path, wrap dalam array
            $this->attributes['document_path'] = json_encode([$value]);
            return;
        }

        $this->attributes['document_path'] = json_encode([]);
    }

    protected static function booted()
    {
        static::updating(function ($submission) {
            if (
                $submission->isDirty('status') &&
                $submission->getOriginal('status') === 'finished'
            ) {
                throw new RuntimeException('Tidak dapat mengubah status pengajuan yang sudah selesai.');
            }
        });
    }

    public function isFinished(): bool
    {
        return $this->status === 'finished';
    }
}