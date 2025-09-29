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
        Schema::create('land_auction_applications', function (Blueprint $table) {
            $table->id();
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
            $table->string('auction_cadastral_number', 25);
            $table->string('landmarks', 256);
            $table->decimal('area', 10, 2);
            $table->string('purpose', 256);
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
        Schema::dropIfExists('land_auction_applications');
    }
};
