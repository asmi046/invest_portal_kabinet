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
        Schema::create('construction_permits', function (Blueprint $table) {
            $table->id();

            // 1.1 Сведения о физическом лице
            $table->string('last_name', 256);
            $table->string('first_name', 256);
            $table->string('middle_name', 256)->nullable();
            $table->string('passport_name', 256);
            $table->string('passport_series', 10);
            $table->string('passport_number', 10);
            $table->string('passport_issued_by', 256);
            $table->date('passport_issued_at')->nullable();
            $table->string('passport_code', 10)->nullable();
            $table->string('ogrnip', 13)->nullable();
            $table->string('inn', 12)->nullable();

            // 1.2 Сведения о юр. лице
            $table->string('company_name', 256)->nullable();
            $table->string('ogrn', 13)->nullable();
            $table->string('inn_company', 12)->nullable();
            $table->string('director_last_name', 256)->nullable();
            $table->string('director_first_name', 256)->nullable();
            $table->string('director_middle_name', 256)->nullable();
            $table->string('director_passport_name', 256)->nullable();
            $table->string('director_passport_series', 10)->nullable();
            $table->string('director_passport_number', 10)->nullable();
            $table->string('director_passport_issued_by', 256)->nullable();
            $table->date('director_passport_issued_at')->nullable();
            $table->string('director_passport_code', 10)->nullable();

            // 1.3 Сведения о представителе
            $table->string('rep_last_name', 256)->nullable();
            $table->string('rep_first_name', 256)->nullable();
            $table->string('rep_middle_name', 256)->nullable();
            $table->string('rep_passport_name', 256)->nullable();
            $table->string('rep_passport_series', 10)->nullable();
            $table->string('rep_passport_number', 10)->nullable();
            $table->string('rep_passport_issued_by', 256)->nullable();
            $table->date('rep_passport_issued_at')->nullable();
            $table->string('rep_passport_code', 10)->nullable();
            $table->string('rep_doc_name', 256)->nullable();
            $table->string('rep_doc_number', 256)->nullable();
            $table->string('rep_doc_issued_by', 256)->nullable();
            $table->date('rep_doc_issued_at')->nullable();

            // Сведения об объекте
            $table->string('object_name', 256);
            $table->string('object_cadastral_number', 20)->nullable();

            // Сведения о земельном участке
            $table->string('land_cadastral_number', 256);
            $table->string('land_docs', 256)->nullable();

            // Документы
            $table->binary('document')->nullable();
            $table->string('document_number', 256)->nullable();
            $table->date('document_date')->nullable();
            $table->binary('attachment')->nullable();

            // Контакты
            $table->string('phone', 20);
            $table->string('email', 256)->nullable();

            // Результат рассмотрения
            $table->string('result', 256)->nullable();

            // Подпись
            $table->string('signature', 100);
            $table->string('initials', 60);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('construction_permits');
    }
};
