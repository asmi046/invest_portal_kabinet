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


            // Организация/заявитель (основные сведения)
            $table->string('supplier_org', 256);
            $table->string('applicant_name', 256);
            $table->string('address', 256);
            $table->string('phone', 20)->nullable();
            $table->string('email', 100)->nullable();

            // Заявление
            $table->string('statement_applicant_name', 256);
            $table->string('object_name', 256);
            $table->string('object_address', 256);
            $table->text('object_description')->nullable();

            // Приложения
            $table->binary('attachments')->nullable();

            // Подпись
            $table->string('last_name', 256);
            $table->string('first_name', 256);
            $table->string('middle_name', 256)->nullable();
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
        Schema::dropIfExists('water_connections');
    }
};
