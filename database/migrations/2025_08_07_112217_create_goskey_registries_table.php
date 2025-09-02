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
        Schema::create('goskey_registries', function (Blueprint $table) {
            $table->id();
            $table->uuid('message_id')->comment('ID сообщения');
            $table->string('short_identifier', 70)->comment('Короткий идентификатор');
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->comment('ID пользователя');
            $table->morphs('registryable');
            $table->timestamp('last_check_at')->nullable()->comment('Дата и время последней проверки');
            $table->string('status')->nullable()->comment('Статус');
            $table->string('status_code')->nullable()->comment('Код статуса');
            $table->string('error_code')->nullable()->comment('Код ошибки');
            $table->string('error_message')->nullable()->comment('Описание ошибки');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goskey_registries');
    }
};
