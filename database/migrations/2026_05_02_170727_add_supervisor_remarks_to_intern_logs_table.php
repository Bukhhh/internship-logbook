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
        Schema::table('intern_logs', function (Blueprint $table) {
            $table->text('supervisor_remarks')->nullable(); // nullable so old tasks don't crash
        });
    }

    public function down(): void
    {
        Schema::table('intern_logs', function (Blueprint $table) {
            $table->dropColumn('supervisor_remarks');
        });
    }
};
