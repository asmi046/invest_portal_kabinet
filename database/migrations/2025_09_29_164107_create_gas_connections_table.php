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
        Schema::create('gas_connections', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->comment("Название проэкта")
                            ->constrained()
                            ->onUpdate('cascade')
                            ->onDelete('cascade');
            $table->string('document_type')->comment("Тип документа");
            $table->boolean('validated')->default(false)->comment("Проверен");
            $table->boolean('editable')->default(true)->comment("Можно редактировать");


            // Физическое лицо (ИП)
            $table->string('full_name', 256)->nullable();
            $table->string('short_name', 256)->nullable();
            $table->string('last_name', 256)->nullable();
            $table->string('first_name', 256)->nullable();
            $table->string('middle_name', 256)->nullable();
            $table->string('residence', 256)->nullable();
            $table->string('postal_address', 256)->nullable();
            $table->string('passport_name', 256)->nullable();
            $table->string('passport_series', 10)->nullable();
            $table->string('passport_number', 10)->nullable();
            $table->string('passport_issued_by', 256)->nullable();
            $table->date('passport_issued_at')->nullable();
            $table->string('passport_code', 10)->nullable();

            // Юридическое лицо
            $table->string('egrul_number', 13)->nullable();
            $table->string('egrip_number', 13)->nullable();
            $table->date('registry_date')->nullable();

            // Общие данные
            $table->string('contact_info', 256)->nullable();
            $table->date('land_doc_date')->nullable();
            $table->string('land_doc_number', 256)->nullable();
            $table->string('reason', 256)->nullable();
            $table->string('object_name', 256)->nullable();
            $table->string('object_address', 256)->nullable();

            // Радио-кнопки (boolean)
            $table->boolean('need_on_land')->default(false);
            $table->boolean('need_design')->default(false);
            $table->boolean('need_equipment_installation')->default(false);
            $table->boolean('need_pipeline_construction')->default(false);
            $table->boolean('need_meter_installation')->default(false);
            $table->boolean('need_meter_supply')->default(false);
            $table->boolean('need_equipment_supply')->default(false);

            // Параметры потребления газа
            $table->decimal('gas_flow_total', 10, 2)->nullable();
            $table->decimal('gas_flow_new', 10, 2)->nullable();
            $table->decimal('gas_flow_existing', 10, 2)->nullable();
            $table->date('planned_date')->nullable();

            // Точки подключения (минимум 1, может быть N)
            $table->smallInteger('connection_point')->nullable();
            $table->date('connection_planned_date')->nullable();
            $table->decimal('connection_flow_total', 10, 2)->nullable();
            $table->decimal('connection_flow_new', 10, 2)->nullable();
            $table->decimal('connection_flow_existing', 10, 2)->nullable();

            // Характеристика потребления
            $table->string('consumption_type', 256)->nullable();

            // Ранее выданные тех. условия
            $table->string('previous_tech_number', 256)->nullable();
            $table->string('previous_tech_date', 256)->nullable();

            // Доп. информация
            $table->string('additional_info', 256)->nullable();
            $table->string('notification_method', 256)->nullable();

            // Приложения
            $table->binary('attachments')->nullable();

            // Заявитель
            $table->string('applicant_last_name', 256);
            $table->string('applicant_first_name', 256);
            $table->string('applicant_middle_name', 256)->nullable();
            $table->string('applicant_phone', 20);
            $table->string('applicant_position', 256)->nullable();
            $table->string('applicant_signature', 100);
            $table->date('applicant_date')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gas_connections');
    }
};
