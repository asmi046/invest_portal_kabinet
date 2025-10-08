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

            $table->foreignId('user_id')->comment("Название проэкта")
                                        ->constrained()
                                        ->onUpdate('cascade')
                                        ->onDelete('cascade');
            $table->string('document_type')->comment("Тип документа");
            $table->boolean('validated')->default(false)->comment("Проверен");
            $table->boolean('editable')->default(true)->comment("Можно редактировать");
            $table->string('state')->comment("Статус документа");


            // 1.1 Сведения о физическом лице
            $table->string('applicant_name', 256)->nullable()->comment('Заявитель');
            $table->string('applicant_passport_data', 556)->nullable()->comment('Паспортные данные');
            $table->string('applicant_ogrn', 256)->nullable()->comment('ОГРН / ОГРНИП');
            $table->string('applicant_inn', 256)->nullable()->comment('ИНН');

            // 1.2 Сведения о юр. лице
            $table->string('applicant_company_name', 256)->nullable()->comment('Заявитель (ЮЛ)');
            $table->string('applicant_company_passport_data', 556)->nullable()->comment('Паспортные данные (ЮЛ)');
            $table->string('applicant_company_ogrn', 256)->nullable()->comment('ОГРН / ОГРНИП (ЮЛ)');
            $table->string('applicant_company_inn', 256)->nullable()->comment('ИНН (ЮЛ)');

            // 1.3 Сведения о представителе
            $table->string('applicant_company_name', 256)->nullable()->comment('Заявитель (Представитель)');
            $table->string('applicant_company_passport_data', 556)->nullable()->comment('Паспортные данные (Представитель)');
            $table->string('applicant_company_ogrn', 256)->nullable()->comment('ОГРН / ОГРНИП (Представитель)');
            $table->string('applicant_company_inn', 256)->nullable()->comment('ИНН (Представитель)');
            $table->date('rep_doc_issued_at')->nullable()->comment('Доверенность');

            // Сведения об объекте
            $table->text('object_name')->nullable()->comment('Наименование объекта');
            $table->string('object_cadastral_number', 20)->nullable()->comment('Кадастровый номер объекта');

            // Сведения о земельном участке
            $table->string('land_cadastral_number', 256)->comment('Кадастровый номер земельного участка');
            $table->string('land_docs', 256)->nullable()->comment('Реквизиты утвержденного проекта межевания территории');

            // строительство объекта на основании документов
            $table->string('doc_name', 556)->nullable();
            $table->string('doc_number', 256)->nullable();
            $table->date('doc_date')->nullable();

            // Контакты
            $table->string('phone', 20)->nullable();
            $table->string('email', 100)->nullable();

            // Результат предоставления услуги
            $table->string('send_result_type', 550)->default('Направить на ГосУслуги');
            $table->string('send_mfc_adress', 550)->nullable()->comment('Предоставление в коммитете или МФЦ');
            $table->string('send_post_adress', 550)->nullable()->comment('Отправить на почтовый адрес');

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
