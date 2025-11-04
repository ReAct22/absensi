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
        Schema::create('attendance_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id');
            $table->time('check_in_time');
            $table->time('check_out_time');
            $table->decimal('location_lat');
            $table->decimal('location_long');
            $table->enum('status', ['Hadir', 'Terlambat', 'Pulang Cepat', 'Lembur', 'Izin', 'Alpha'])->default('Hadir');
            $table->decimal('total_work_hours');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_logs');
    }
};
