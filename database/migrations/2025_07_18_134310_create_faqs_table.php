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
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('faq_category_id');
            $table->text('question');
            $table->text('answer');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->integer('sort_order')->default(0)->comment('Untuk mengurutkan pertanyaan dalam satu kategori');
            $table->timestamps();
            
            // Foreign key constraint
            $table->foreign('faq_category_id')->references('id')->on('faq_categories')->onDelete('cascade');
            
            // Index for better performance
            $table->index(['faq_category_id', 'sort_order']);
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faqs');
    }
};
