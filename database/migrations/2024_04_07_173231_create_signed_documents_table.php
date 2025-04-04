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
        Schema::create('signed_documents', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('file_real', 1500)->comment('Реальное имя файла');
            $table->string('file', 1500)->comment('Файл');
            $table->string('storage_patch')->comment('Директория в хранилище');
            $table->string('signature', 1500)->nullable()->comment('Файл подписи');
            $table->string('inner_document_type')->comment('Тип документа для которого вложение');
            $table->integer("document_id")->comment('ID документа к которому вложение');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signed_documents');
    }
};
