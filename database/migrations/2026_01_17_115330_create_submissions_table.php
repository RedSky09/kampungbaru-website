<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('service_type');
            $table->string('name');
            $table->string('nik', 16);
            $table->string('phone', 20);
            $table->text('note')->nullable();
            $table->json('document_path');
            $table->enum('status', [
                'pending',
                'approved',
                'rejected',
                'finished',
                ])->default('pending');
            $table->text('rejection_reason')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
