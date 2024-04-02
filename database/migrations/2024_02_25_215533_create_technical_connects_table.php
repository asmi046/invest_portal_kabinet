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
        Schema::create('technical_connects', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')->comment("Название проэкта")
                                        ->constrained()
                                        ->onUpdate('cascade')
                                        ->onDelete('cascade');
            $table->string('state')->comment("Статус документа");
            $table->string("name")->comment("ФИО заявителя");
            $table->string("dolgnost")->comment("Должность заявителя");
            $table->string("phone")->comment("Телефон заявителя");
            $table->string("organization")->comment('Наименование организации');
            $table->string("egrul")->comment("ЕГРИП/ЕГРЮЛ заявителя");
            $table->string("adress")->comment("Адрес заявителя");

            $table->string("pasport_seria")->comment("Серия паспорта");
            $table->string("pasport_number")->comment("Номер паспорта");
            $table->string("pasport_vidan")->comment("Кем выдан паспорт");

            $table->string("osnovanie")->comment("Основание для присоединения");
            $table->string("ustroistvo")->comment("Наименование энергопринимающих устройств");
            $table->string("raspologeie")->comment("место нахождения энергопринимающих устройств");

            $table->string("pover_prin_devices")->comment("Максимальная мощность энергопринимающих устройств");
            $table->string("napr_prin_devices")->comment("При напряжении");
            $table->string("pover_pris_devices")->comment("Максимальная мощность присоединяемых энергопринимающих устройств");
            $table->string("napr_pris_devices")->comment("При напряжении");
            $table->string("pover_pris_r_devices")->nullable()->comment("Максимальная мощность ранее присоединенных в данной точке");
            $table->string("napr_pris_r_devices")->nullable()->comment("При напряжении");
            $table->string("rashet_plati")->default('Вариант 1')->comment("Порядок расчета и условия рассрочки внесения платы");
            $table->string("gen_postavhik")->comment("Гарантирующий поставщик");
            $table->text("prilogenie")->nullable()->comment("Приложения к заявлению");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('technical_connects');
    }
};
