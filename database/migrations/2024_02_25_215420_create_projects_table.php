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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')->comment("Название проэкта")
                                        ->constrained()
                                        ->onUpdate('cascade')
                                        ->onDelete('cascade');
            $table->string('state')->comment("Статус документа");
            $table->string('name')->comment("Название проэкта");
            $table->string('target', 500)->comment("Цель проекта");
            $table->integer('time_relis')->comment("Срок реализации");
            $table->integer('worck_place_coun')->comment("Количество создаваемых рабочих мест");
            $table->string('relis_area')->comment("Территория реализации проекта");
            $table->integer('invest_volume')->comment("Общий объем инвестиций, млн. руб.");
            $table->text('project_description')->comment("Описание проекта");
            $table->text('erth_area_description')->comment("Потребность в земельном участке и его краткая характеристика");
            $table->text('prom_area_description')->comment("Потребность в промышленной площадке и ее краткая характеристика");

            $table->integer('dop_volume')->default(0)->comment("Потребность в привлечении дополнительных средств для реализации инвестиционного проекта");
            $table->integer('electro')->default(0)->comment("Потребность в создании инженерной инфраструктуры (мощность, потребляемая по проекту в час)");
            $table->integer('gaz')->default(0)->comment("Потребность в создании инженерной инфраструктуры (мощность, потребляемая по проекту в час)");

            $table->boolean("gos_support")->default(0)->comment("Необходимость в государственной поддержке");
            $table->string("gos_support_direction",600)->nullable()->comment("Направление государственной поддержки");
            $table->text('description')->nullable()->comment("Комментарии к проекту");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
