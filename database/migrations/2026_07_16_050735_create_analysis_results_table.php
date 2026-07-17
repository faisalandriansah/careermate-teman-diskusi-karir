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
        Schema::create('analysis_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('cv_file_id')->constrained('c_v_files')->cascadeOnDelete();
            $table->foreignId('career_id')->nullable()->constrained()->nullOnDelete();
            $table->decimal('match_score', 5, 2)->default(0);
            $table->json('skills_json')->nullable();
            $table->json('skill_gap_json')->nullable();
            $table->json('roadmap_json')->nullable();
            $table->longtext('ai_summary')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analysis_results');
    }
};
