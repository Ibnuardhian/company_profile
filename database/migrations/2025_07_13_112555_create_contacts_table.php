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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_profile_id')->comment('Foreign key ke company_profile');
            $table->enum('type', ['email', 'phone', 'whatsapp', 'facebook', 'instagram', 'twitter', 'linkedin', 'youtube', 'tiktok', 'website', 'other'])->comment('Jenis kontak');
            $table->string('label', 100)->nullable()->comment('Label untuk kontak (misal: Admin, Customer Service, etc)');
            $table->text('value')->comment('Nilai kontak (email, nomor telepon, URL, etc)');
            $table->boolean('is_primary')->default(false)->comment('Apakah ini kontak utama untuk tipe tersebut');
            $table->boolean('is_active')->default(true)->comment('Status aktif kontak');
            $table->integer('sort_order')->default(0)->comment('Urutan tampil');
            $table->timestamps();
            
            // Foreign key constraint
            $table->foreign('company_profile_id')->references('id')->on('company_profile')->onDelete('cascade');
            
            // Index
            $table->index(['company_profile_id', 'type', 'is_active']);
            $table->index(['company_profile_id', 'is_primary']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
