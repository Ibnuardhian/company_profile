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
        Schema::create('company_profile', function (Blueprint $table) {
            $table->id();
            $table->string('name', 191)->comment('Nama perusahaan');
            $table->string('logo_path', 255)->nullable()->comment('Path file logo di storage');
            $table->text('description')->nullable()->comment('Deskripsi singkat');
            $table->text('vision')->nullable()->comment('Visi');
            $table->text('mission')->nullable()->comment('Misi');
            $table->string('primary_color', 7)->nullable()->default('#FF0000')->comment('Contoh: #FF0000');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_profile');
    }
};
