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
        Schema::table('attendance_logs', function (Blueprint $table) {
            $table->decimal('location_lat_out', 10,7)->nullable()->after('location_lat');
            $table->decimal('location_long_out', 10,7)->nullable()->after('location_long');
            $table->enum('status_out', ['Pulang Cepat', 'Lembur'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendance_logs', function (Blueprint $table) {
            $table->dropColumn(['location_lat_out', 'location_long_out', 'status_out']);
        });
    }
};
