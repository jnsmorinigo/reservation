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
        Schema::create('employee_working_hours', function (Blueprint $table) {
            $table->foreignId('employee_id')->constrained()->onDelete('restrict');
            $table->foreignId('working_hour_id')->constrained()->onDelete('restrict');

            $table->primary(['employee_id', 'working_hour_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_working_hours');
    }
};
