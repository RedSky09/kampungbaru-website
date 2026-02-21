<?php

namespace App\Filament\Resources\Submissions\Pages;

use App\Filament\Resources\Submissions\SubmissionResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditSubmission extends EditRecord
{
    protected static string $resource = SubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
    protected function mutateFormDataBeforeSave(array $data): array
    {
        if ($this->record->status === 'finished') {
            abort(403, 'Pengajuan sudah selesai dan tidak bisa diubah');
        }
        
        if ($data['status'] === 'rejected' && empty($data['rejection_reason'])) {
            throw new \Filament\Support\Exceptions\Halt('Alasan penolakan wajib diisi');
        }
        
        return $data;
    }
}
