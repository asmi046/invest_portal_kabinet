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

            // Сведения о застройщике
            $table->date('form_date')->nullable();
            $table->text('authority_name')->nullable();

            // Физическое лицо
            $table->string('last_name', 256)->nullable();
            $table->string('first_name', 256)->nullable();
            $table->string('middle_name', 256)->nullable();
            $table->string('passport_name', 256)->nullable();
            $table->string('passport_series', 10)->nullable();
            $table->string('passport_number', 10)->nullable();
            $table->string('passport_issued_by', 256)->nullable();
            $table->date('passport_issued_at')->nullable();
            $table->string('passport_code', 10)->nullable();

            // Индивидуальный предприниматель
            $table->string('ogrnip', 13)->nullable();

            // Юридическое лицо
            $table->string('company_name', 256)->nullable();
            $table->string('ogrn', 13)->nullable();
            $table->string('inn_company', 12)->nullable();

            // Сведения об объекте
            $table->text('object_name')->nullable();
            $table->text('object_address')->nullable();

            // Земельный участок
            $table->string('land_cadastral_number', 256)->nullable();

            // Разрешение на строительство
            $table->string('permit_index', 256)->nullable();
            $table->string('permit_authority', 256)->nullable();
            $table->string('permit_number', 256)->nullable();
            $table->date('permit_date')->nullable();

            // Ранее выданные разрешения
            $table->string('previous_permit_index', 256)->nullable();
            $table->string('previous_permit_authority', 256)->nullable();
            $table->string('previous_permit_number', 256)->nullable();
            $table->date('previous_permit_date')->nullable();

            // Ввод объекта на основании документов
            $table->string('doc_index', 256)->nullable();
            $table->string('doc_name', 256)->nullable();
            $table->string('doc_number', 256)->nullable();
            $table->date('doc_date')->nullable();
            $table->binary('doc_attachment')->nullable();

            // Контакты
            $table->string('phone', 20)->nullable();
            $table->string('email', 100)->nullable();

            // Результат предоставления услуги
            $table->string('result_portal', 100)->nullable();
            $table->string('result_mfc', 100)->nullable();
            $table->string('result_mail', 256)->nullable();

            // Подпись
            $table->string('sign_last_name', 256)->nullable();
            $table->string('sign_first_name', 256)->nullable();
            $table->string('sign_middle_name', 256)->nullable();
            $table->string('signature', 100)->nullable();

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
