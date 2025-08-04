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
        Schema::create('organization_document_types', function (Blueprint $table) {
            $table->id();
            
            // Связь с организацией
            $table->foreignId('organization_id')
                  ->constrained('organizations')
                  ->onDelete('cascade')
                  ->comment('ID организации');
            
            // Полиморфная связь с типами документов
            $table->string('documentable_type')
                  ->comment('Тип документа (полиморфная связь)');
            
            $table->unsignedBigInteger('documentable_id')
                  ->comment('ID документа (полиморфная связь)');
            
            $table->timestamps();
            
            // Уникальный индекс для предотвращения дублирования
            $table->unique(['organization_id', 'documentable_type', 'documentable_id'], 'org_doc_type_unique');
            
            // Индексы для оптимизации запросов
            $table->index('organization_id');
            $table->index(['documentable_type', 'documentable_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organization_document_types');
    }
};
