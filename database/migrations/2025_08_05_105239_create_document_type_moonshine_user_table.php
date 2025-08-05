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
        Schema::create('document_type_moonshine_user', function (Blueprint $table) {
            $table->id();

            // Связь с типом документа
            $table->foreignId('document_type_id')
                  ->constrained('document_types')
                  ->onDelete('cascade')
                  ->comment('ID типа документа');

            // Связь с пользователем MoonShine
            $table->foreignId('moonshine_user_id')
                  ->constrained('moonshine_users')
                  ->onDelete('cascade')
                  ->comment('ID пользователя MoonShine');


            $table->unique(['document_type_id', 'moonshine_user_id'], 'unique_document_type_user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_type_moonshine_user');
    }
};
