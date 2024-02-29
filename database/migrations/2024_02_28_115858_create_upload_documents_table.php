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
        Schema::create('upload_documents', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('url', 700)->comment('url');
            $table->string('sign', 700)->nullable()->comment('Открепленный файл подписи');
            $table->string('name', 500)->comment('Имя файла');
            $table->integer('user_id')->comment('Пользователь');
            $table->string('document')->comment('Докумен');
            $table->string('document_type')->nullable()->comment('Тип документа');
            $table->integer('model_id')->comment('id документа');
            $table->string('state')->default('temp')->comment('Статус');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upload_documents');
    }
};
