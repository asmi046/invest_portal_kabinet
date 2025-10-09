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
        Schema::create('commissioning_permits', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->comment("Название проэкта")
                                        ->constrained()
                                        ->onUpdate('cascade')
                                        ->onDelete('cascade');
            $table->string('document_type')->comment("Тип документа");
            $table->boolean('validated')->default(false)->comment("Проверен");
            $table->boolean('editable')->default(true)->comment("Можно редактировать");
            $table->string('state')->comment("Статус документа");

            $table->string('supplier_org', 500)->nullable()->comment('Наименование уполномоченного на выдачу разрешений на ввод объекта в эксплуатацию федерального органа исполнительной власти');

            // Сведения о заявителе
            $table->string('applicant_type', 256)->default('Физическое лицо')->comment('Тип заявителя');
            $table->string('applicant_name', 256)->nullable()->comment('Наименование заявителя');
            $table->string('applicant_ogrn', 256)->nullable()->comment('ОГРН / ОГРНИП');
            $table->string('applicant_inn', 256)->nullable()->comment('ИНН');
            $table->string('applicant_passport_data', 556)->nullable()->comment('Паспортные данные');

            // Сведения об объекте
            $table->text('object_name')->nullable()->comment('Наименование объекта капитального строительства (этапа)в соответствии с проектной документацией');
            $table->text('object_address')->nullable()->comment('Адрес (местоположение) объекта');

            // Земельный участок
            $table->string('land_cadastral_number', 256)->nullable()->comment('Кадастровый номер земельного участка');

            // Разрешение на строительство
            $table->string('permit_authority', 256)->nullable();
            $table->string('permit_number', 256)->nullable();
            $table->date('permit_date')->nullable();

            // Ранее выданные разрешения
            $table->string('previous_permit_authority', 256)->nullable();
            $table->string('previous_permit_number', 256)->nullable();
            $table->date('previous_permit_date')->nullable();

            // Ввод объекта на основании документов
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
        Schema::dropIfExists('commissioning_permits');
    }
};
