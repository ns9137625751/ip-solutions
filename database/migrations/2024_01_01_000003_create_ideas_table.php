<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ideas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('summary');
            $table->enum('stage', ['Ideation', 'Proof of Concept', 'Prototype', 'Patent Filed', 'Commercial Stage']);
            $table->string('domain')->nullable();
            $table->string('technology_type')->nullable();
            $table->integer('co_applicants_needed')->default(1);
            $table->decimal('funding_requirement', 15, 2)->nullable();
            $table->date('filing_date')->nullable();
            $table->string('document_path')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ideas');
    }
};
