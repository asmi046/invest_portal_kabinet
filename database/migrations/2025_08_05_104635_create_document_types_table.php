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
        Schema::create('document_types', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->comment('Название типа документа');
            $table->string('short_name')->nullable()->comment('Краткое название типа документа');
            $table->string('model')->comment('Название связанной модели');
            $table->text('description')->nullable()->comment('Описание типа документа');
            $table->integer('order')->default(100)->comment('Порядок сортировки');
            $table->string('create_url')->default("#")->comment('URL для создания документа');
            $table->string('index_url')->default("#")->comment('URL для просмотра списка документов');
            $table->string('icon')->default("#")->comment('Иконка типа документа');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_types');
    }
};
