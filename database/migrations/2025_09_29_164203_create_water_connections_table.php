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
        Schema::create('water_connections', function (Blueprint $table) {
           $table->id();

            $table->foreignId('user_id')->comment("Название проэкта")
                                        ->constrained()
                                        ->onUpdate('cascade')
                                        ->onDelete('cascade');
            $table->string('document_type')->comment("Тип документа");
            $table->boolean('validated')->default(false)->comment("Проверен");
            $table->boolean('editable')->default(true)->comment("Можно редактировать");
            $table->string('state')->comment("Статус документа");


            // Организация/заявитель (основные сведения)
            $table->string('supplier_org', 256)->nullable();
            $table->string('applicant_name', 256)->nullable()->comment('Заявитель');
            $table->string('address', 256)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('email', 100)->nullable();

            // Заявление
            $table->string('object_name', 256)->nullable();
            $table->string('object_address', 256)->nullable();
            $table->text('object_description')->nullable();

            $table->float('payload_all_snab', 8, 2)->default(0)->comment("Общая нагрузка на водоснабжение, м3/сут");
            $table->float('payload_all_ot', 8, 2)->default(0)->comment("Общая нагрузка на водоотведение, м3/час");
            $table->float('payload_hoz_snab', 8, 2)->default(0)->comment("Нагрузка на хозяйственные нужды на водоснабжение, м3/сут");
            $table->float('payload_hoz_ot', 8, 2)->default(0)->comment("Нагрузка на хозяйственные нужды на водоотведение, м3/час");
            $table->float('payload_prom_snab', 8, 2)->default(0)->comment("Нагрузка на производственные нужды на водоснабжение, м3/сут");
            $table->float('payload_prom_ot', 8, 2)->default(0)->comment("Нагрузка на производственные нужды , м3/час");
            $table->float('payload_fire_snab', 8, 2)->default(0)->comment("Нагрузка на пожарные нужды на водоснабжение, л/сек");
            $table->float('payload_fire_ot', 8, 2)->default(0)->comment("Нагрузка на пожарные нужды на водоотведение, л/сек");


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('water_connections');
    }
};
