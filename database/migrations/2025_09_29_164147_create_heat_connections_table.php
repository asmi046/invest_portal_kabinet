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
        Schema::create('heat_connections', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->comment("Название проэкта")
                                        ->constrained()
                                        ->onUpdate('cascade')
                                        ->onDelete('cascade');
            $table->string('document_type')->comment("Тип документа");
            $table->boolean('validated')->default(false)->comment("Проверен");
            $table->boolean('editable')->default(true)->comment("Можно редактировать");


            // Организация
            $table->string('organization_name', 256);
            $table->string('legal_address', 256);
            $table->string('postal_address', 256);
            $table->string('phone_fax', 256)->nullable();
            $table->string('bank_name', 256)->nullable();
            $table->string('account_number', 256)->nullable();
            $table->string('correspondent_account', 256)->nullable();
            $table->string('bik', 256)->nullable();
            $table->string('inn_kpp', 256)->nullable();
            $table->string('egrul_number', 256)->nullable();

            // Объект
            $table->string('object_name', 256);
            $table->string('object_address', 256);

            // Параметры теплоносителя
            $table->decimal('heat_pressure', 10, 2)->nullable();
            $table->decimal('heat_temperature', 5, 2)->nullable();
            $table->boolean('has_meter')->default(false);
            $table->string('consumption_mode', 20)->nullable();
            $table->string('reliability_category', 50)->nullable();
            $table->boolean('has_own_source')->default(false);
            $table->year('commissioning_year')->nullable();
            $table->string('land_usage_info', 256)->nullable();
            $table->string('construction_limits', 256)->nullable();

            // Приложения
            $table->binary('attachments')->nullable();

            // Заявитель
            $table->string('last_name', 256);
            $table->string('first_name', 256);
            $table->string('middle_name', 256)->nullable();
            $table->string('contact_phone', 20);
            $table->string('position', 256)->nullable();
            $table->string('signature', 100);
            $table->date('application_date')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('heat_connections');
    }
};
