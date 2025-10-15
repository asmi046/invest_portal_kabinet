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
            $table->string('state')->comment("Статус документа");

            // Физическое лицо (ИП)

            $table->string('applicant_name', 256)->nullable()->comment('Заявитель');
            $table->string('applicant_ogrn', 256)->nullable()->comment('ОГРН / ОГРНИП');
            $table->date('applicant_ogrn_data')->nullable()->comment('ОГРН / ОГРНИП (дата регистрации)');
            $table->string('applicant_address', 256)->nullable()->comment('Адрес заявителя');
            $table->string('applicant_passport_data', 556)->nullable()->comment('Паспортные данные');
            $table->string('applicant_connect_variants', 556)->nullable()->comment('Способы обмена информацией');

            $table->string('phone', 20)->nullable();
            $table->string('email', 100)->nullable();

            $table->string('land_docs', 256)->nullable()->comment('Реквизиты утвержденного проекта межевания территории либо сведения о наличии схемы расположения земельного участка');

            // Общие данные
            $table->string('reason', 256)->nullable()->comment('Основание для подключения к газораспределительной сети');
            $table->string('object_name', 500)->nullable()->comment('Наименование объекта');
            $table->string('object_address', 500)->nullable()->comment('Адрес (местоположение) объекта');

            // Радио-кнопки (boolean)
            $table->boolean('need_any_works')->default(false)->comment('Необходимость дополнительных работ');
            $table->boolean('need_design')->default(false)->comment('Необходимость проектирования');
            $table->boolean('need_equipment_installation')->default(false)->comment('Необходимость установки оборудования');
            $table->boolean('need_pipeline_construction')->default(false)->comment('Необходимость либо реконструкции внутреннего газопровода');
            $table->boolean('need_meter_installation')->default(false)->comment('Необходимость установки прибора учета газа');
            $table->boolean('need_meter_supply')->default(false)->comment('Необходимость поставки прибора учета газа');
            $table->boolean('need_equipment_supply')->default(false)->comment('Необходимость по поставке газоиспользующего оборудования');

            // Параметры потребления газа
            $table->decimal('gas_flow_total', 10, 2)->nullable()->comment('Величина максимального часового расхода газа (мощности)');
            $table->decimal('gas_flow_new', 10, 2)->nullable()->comment('Величина максимального часового расхода газа (мощности) подключаемого газоиспользующего оборудования');
            $table->decimal('gas_flow_existing', 10, 2)->nullable()->comment('Величина максимального часового расхода газа (мощности) подключенного газоиспользующего оборудования');
            $table->date('planned_date')->nullable() ->comment('Планируемый срок проектирования, строительства и ввода в эксплуатацию объекта капитального строительства');

            // Точки подключения (минимум 1, может быть N)
            $table->integer('connection_point')->nullable()->comment('Точка подключения');
            $table->date('connection_planned_date')->nullable()->comment('Планируемый срок проектирования, строительства и ввода в эксплуатацию объекта капитального строительства, в том числе по этапам и очередям (месяц, год)');
            $table->decimal('connection_flow_total', 10, 2)->nullable()->comment('Итоговая величина максимального часового расхода газа');
            $table->decimal('connection_flow_new', 10, 2)->nullable()->comment('Величина максимального расхода газа ');
            $table->decimal('connection_flow_existing', 10, 2)->nullable()->comment('Величина максимального часового расхода газа');

            // Характеристика потребления
            $table->string('consumption_type', 256)->nullable()->comment('Характеристика потребления газа (вид экономической деятельности заявителя - юридического лица или индивидуального предпринимателя) ');

            // Ранее выданные тех. условия
            $table->string('previous_tech_number', 256)->nullable()->comment('Номер ранее выданных технических условий');
            $table->date('previous_tech_date')->nullable()->comment('Дата ранее выданных технических условий');

            // Доп. информация
            $table->text('additional_info')->nullable()->comment('Дополнительная информация');
            $table->string('notification_method', 256)->nullable()->comment('Способ уведомления о подключении');

            $table->text('attention_details')->nullable()->comment('Описание вложений');

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
