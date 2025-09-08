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
        Schema::table('users', function (Blueprint $table) {
            $table->string('ul_name')->nullable()->comment('Юридическое лицо');
            $table->string('ul_inn')->nullable()->comment('ИНН');
            $table->string('ul_ogrn')->nullable()->comment('ОГРН');
            $table->string('ul_attorney')->nullable()->comment('Доверенность (МЧД)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('ul_name');
            $table->dropColumn('ul_inn');
            $table->dropColumn('ul_ogrn');
        });
    }
};
