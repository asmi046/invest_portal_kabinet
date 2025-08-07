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
        Schema::create('stages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Название этапа');
            $table->integer('order')->default(0)->comment('Порядковый номер этапа');
            $table->text('description')->nullable()->comment('Описание этапа');
            $table->foreignId('document_type_id')->constrained('document_types')->onDelete('cascade')->comment('ID типа документа');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stages');
    }
};
