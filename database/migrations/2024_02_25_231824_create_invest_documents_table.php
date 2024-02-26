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
        Schema::create('invest_documents', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title', 600)->comment("Название документа");
            $table->string('subtype')->comment("Раздел");
            $table->string('file')->comment("Файл для скачивания");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invest_documents');
    }
};
