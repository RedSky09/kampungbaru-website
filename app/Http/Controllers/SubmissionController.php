<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Helpers\SubmissionCode;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SubmissionController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'service_type' => 'required|string',
                'name'         => 'required|string|max:255',
                'nik'          => 'required|string|digits:16',
                'phone'        => 'required|string|max:20',
                'note'         => 'nullable|string',
                'document'     => 'required|array',
                'document.*'   => 'file|mimes:pdf,jpg,jpeg,png|max:5120',
            ]);

            $paths = [];
            if ($request->hasFile('document')) {
                foreach ($request->file('document') as $file) {
                    $paths[] = $file->store('submissions', 'public');
                }
            }

            // generate kode unik (ANTI DUPLIKAT YGY)
            $code = SubmissionCode::generate();

            Submission::create([
                'code'          => $code,
                'service_type'  => $validated['service_type'],
                'name'          => $validated['name'],
                'nik'           => $validated['nik'],
                'phone'         => $validated['phone'],
                'note'          => $validated['note'] ?? null,
                'document_path' => $paths,
                'status'        => 'pending',
            ]);

            return response()->json([
                'success' => true,
                'code'    => $code,
            ]);
            
            } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $e->errors(),
            ], 422);
            } catch (\Throwable $e) {
            report($e);

            return response()->json([
                'success' => false,
                'message' => 'Kesalahan server',
            ], 500);
        }
    }
    public function track($code)
    {
        $submission = Submission::where('code', $code)->first();
        if (! $submission) {
            return response()->json([
                'success' => true,
                'data' => [
                    'code' => $submission->code,
                    'service_type' => $submission->service_type,
                    'name' => substr($submission->name, 0, 3) . '*****',
                    'status' => $submission->status,
                    'reason' => $submission->rejection_reason,
                    'created_at' => $submission->created_at->format('d M Y H:i'),
                ],
            ]);

        }
        
        return response()->json([
            'code' => $submission->code,
            'service_type' => $submission->service_type,
            'name' => substr($submission->name, 0, 1) . '***',
            'status' => $submission->status,
            'reason' => $submission->rejection_reason,
            'created_at' => $submission->created_at->format('d M Y H:i'),
        ]);
    }
}