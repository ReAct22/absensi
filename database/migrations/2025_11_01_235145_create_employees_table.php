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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_code');
            $table->string('full_name');
            $table->string('email');
            $table->string('phone_number');
            $table->enum('gender', ['L', 'P']);
            $table->foreignId('position_id');
            $table->foreignId('department_id');
            $table->date('hire_date');
            $table->enum('employment_status', ['Tetap', 'Kontrak', 'Magang']);
            $table->string('photo_profile');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
