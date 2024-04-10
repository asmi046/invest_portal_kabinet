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
            $table->string("dolgnost")->nullable()->comment("Должность заявителя");
            $table->string("phone")->nullable()->comment("Телефон заявителя");
            $table->string("organization")->nullable()->comment('Наименование организации');
            $table->string("egrul")->nullable()->comment("ЕГРИП/ЕГРЮЛ заявителя");
            $table->string("adress")->nullable()->comment("Адрес заявителя");
            $table->string("okved")->nullable()->comment("Вид экономической деятельности заявителя");

            $table->string("pasport_seria")->nullable()->comment("Серия паспорта");
            $table->string("pasport_number")->nullable()->comment("Номер паспорта");
            $table->string("pasport_vidan")->nullable()->comment("Кем выдан паспорт");

            $table->string("osnovanie")->nullable()->comment("Основание для присоединения");
            $table->string("ustroistvo")->nullable()->comment("Наименование энергопринимающих устройств");
            $table->string("raspologeie")->nullable()->comment("место нахождения энергопринимающих устройств");

            $table->string("pover_prin_devices")->nullable()->comment("Максимальная мощность энергопринимающих устройств");
            $table->string("napr_prin_devices")->nullable()->comment("При напряжении");
            $table->string("pover_pris_devices")->comment("Максимальная мощность присоединяемых энергопринимающих устройств");
            $table->string("napr_pris_devices")->nullable()->comment("При напряжении");
            $table->string("pover_pris_r_devices")->nullable()->nullable()->comment("Максимальная мощность ранее присоединенных в данной точке");
            $table->string("napr_pris_r_devices")->nullable()->nullable()->comment("При напряжении");
            $table->string("rashet_plati")->nullable()->default('Вариант 1')->comment("Порядок расчета и условия рассрочки внесения платы");
            $table->string("gen_postavhik")->comment("Гарантирующий поставщик");
            $table->json("etaps")->nullable()->comment("Этапы строительство");
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
