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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();

            $table->string('name')->comment('Название организации');
            $table->string('short_name')->comment('Сокращенное название организации');
            $table->string('phone')->nullable()->comment('Телефон организации');
            $table->string('email')->nullable()->comment('Email организации');

            $table->timestamps();

            // Индексы для оптимизации поиска
            $table->index('name');
            $table->index('short_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
