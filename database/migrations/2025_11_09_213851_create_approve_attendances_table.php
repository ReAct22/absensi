<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('approve_attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->delete('cascade');
            $table->enum('status', ['Approve', 'Pending', 'Tolak'])->default('Pending');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approve_attendances');
    }
};
