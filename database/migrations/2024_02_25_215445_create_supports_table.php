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
        Schema::create('supports', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("organization")->comment('Наименование организации');
            $table->string("name")->comment('Название инвестиционного проекта');
            $table->integer("invest_volume")->comment('Объем инвестиций в основной капитал по проекту (с учетом налога на добавленную стоимость), млн. рублей');
            $table->string("detail",1000)->comment('Инвестиционный проект предусматривает');
            $table->string("many_src")->comment('Источник средств реализации проекта');
            $table->integer('time_relis')->comment("Срок реализации инвестиционного проекта");
            $table->integer('npv')->comment("Чистый приведенный доход проекта (NPV)");
            $table->integer('irr')->comment("Внутренняя норма доходности проекта (IRR)");
            $table->integer('time_prib')->comment("Простой срок окупаемости инвестиционного проекта");
            $table->integer('worck_place_coun')->comment("Количество создаваемых рабочих мест");
            $table->integer('zp')->comment("Средняя заработная плата по проекту");
            $table->integer('okved')->comment("Средняя заработная плата по проекту");
            $table->text('description')->nullable()->comment("Комментарии к проекту");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supports');
    }
};
