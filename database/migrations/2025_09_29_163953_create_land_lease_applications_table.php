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
        Schema::create('land_lease_applications', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->comment("Название проэкта")
                                        ->constrained()
                                        ->onUpdate('cascade')
                                        ->onDelete('cascade');
            $table->string('document_type')->comment("Тип документа");
            $table->boolean('validated')->default(false)->comment("Проверен");
            $table->boolean('editable')->default(true)->comment("Можно редактировать");

            $table->string('company_name', 256);
            $table->string('ogrn', 13);
            $table->string('inn', 12);
            $table->string('address', 256);
            $table->string('position', 256);
            $table->string('representative_name', 256);
            $table->string('document_name', 256);
            $table->string('document_details', 256);
            $table->string('postal_address', 256);
            $table->string('phone', 20);
            $table->string('email', 256)->nullable();
            $table->string('cadastral_number', 25);
            $table->decimal('area', 10, 2);
            $table->date('lease_term')->nullable();
            $table->string('landmarks', 256);
            $table->string('purpose', 256);
            $table->string('legal_basis', 256);
            $table->string('preliminary_decision', 256)->nullable();
            $table->string('planning_decision', 256)->nullable();
            $table->string('withdrawal_decision', 256)->nullable();
            $table->text('consent_confirmation')->nullable();
            $table->string('signature', 100);
            $table->string('initials', 60);
            $table->date('application_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('land_lease_applications');
    }
};
