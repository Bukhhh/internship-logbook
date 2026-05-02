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
       Schema::create('intern_logs', function (Blueprint $table) {
        $table->id();
        $table->string('task_name'); // This is the column MySQL was missing!
        $table->text('details');
        $table->enum('status', ['ongoing', 'completed', 'stuck'])->default('ongoing');
        $table->date('log_date');
        $table->timestamps(); // This creates created_at and updated_at
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intern_logs');
    }
};
