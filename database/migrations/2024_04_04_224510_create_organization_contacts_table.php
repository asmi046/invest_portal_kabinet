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
        Schema::create('organization_contacts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('person')->comment('Ответственный');
            $table->string('dolgnost')->nullable()->comment('Должность');
            $table->string('organization')->comment('Организация');
            $table->string('phone')->comment('Телефон');
            $table->string('email')->nullable()->comment('Телефон');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organization_contacts');
    }
};
