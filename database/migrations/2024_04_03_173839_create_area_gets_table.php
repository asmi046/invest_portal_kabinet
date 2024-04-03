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
        Schema::create('area_gets', function (Blueprint $table) {
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

            $table->string("object_name")->comment("Наименование объекта");
            $table->string("object_type")->default('Масштабный инвестиционный проект')->comment("Тип объекта");
            $table->integer("prilogenie_list_count")->nullable()->comment("Приложения к заявлению (количество листов)");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('area_gets');
    }
};
