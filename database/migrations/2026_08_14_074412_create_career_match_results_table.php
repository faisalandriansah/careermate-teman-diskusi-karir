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
        Schema::create('career_match_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('analysis_result_id')->constrained()->cascadeOnDelete();
            $table->foreignId('career_id')->constrained()->cascadeOnDelete();
            $table->decimal('match_score', 5, 2)->default(0);
            $table->json('matched_skills_json')->nullable();
            $table->json('skill_gap_json')->nullable();
            $table->longtext('ai_summary')->nullable();
            $table->json('roadmap_json')->nullable();
            $table->boolean('is_best_match')->default(false);
            $table->timestamps();

            $table->unique(['analysis_result_id', 'career_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('career_match_results');
    }
};
