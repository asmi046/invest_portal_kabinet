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
        Schema::create('land_lease_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->comment("Название проэкта")
                                        ->constrained()
                                        ->onUpdate('cascade')
                                        ->onDelete('cascade');
            $table->string('document_type')->comment("Тип документа");
            $table->boolean('validated')->default(false)->comment("Проверен");
            $table->boolean('editable')->default(true)->comment("Можно редактировать");
            $table->string('state')->comment("Статус документа");


            $table->string('supplier_org')->nullable()->comment('Организация');

            $table->string('applicant_name', 256)->nullable()->comment('Заявитель');
            $table->string('applicant_ogrn', 256)->nullable()->comment('ОГРН / ОГРНИП');
            $table->string('applicant_inn', 256)->nullable()->comment('ИНН');
            $table->string('applicant_address', 256)->nullable()->comment('Адрес заявителя');

            $table->string('person', 256)->nullable()->comment('ФИО представителя');
            $table->string('person_dover', 256)->nullable()->comment('Наименование и реквизиты документа, подтверждающего полномочия представителя заявителя');

            // Контакты
            $table->string('phone', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('post_address', 500)->nullable();

            $table->string('land_cadastral_number', 256)->nullable()->comment('Кадастровый номер земельного участка');
            $table->decimal('area', 10, 2)->default(0)->comment('Площадь земельного участка (кв.м)');
            $table->string('lease_term')->nullable()->comment('Срок аренды земельного участка');

            $table->string('landmarks', 556)->nullable()->comment('Ориентиры земельного участка');
            $table->text('purpose')->nullable()->comment('Цель использования земельного участка');

            $table->text('basis')->nullable()->comment('Основание предоставления земельного участка без проведения торгов');
            $table->string('req_dock')->nullable()->comment('Реквизиты решения о предварительном согласовании предоставления земельного участка');
            $table->string('req_dock_plan')->nullable()->comment('Реквизиты решения об утверждении документа территориального планирования и (или) проекта планировки территории');
            $table->string('req_dock_iz')->nullable()->comment('Реквизиты решения об изъятии земельного участка для государственных или муниципальных нужд');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('land_lease_applications');
    }
};
