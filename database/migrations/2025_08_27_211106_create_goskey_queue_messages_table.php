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
        Schema::create('goskey_queue_messages', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->uuid('original_message_id')->comment('ID сообщения запроса');
            $table->uuid('message_id')->comment('ID сообщения ответа');
            $table->string('type')->nullable()->comment('ID сообщения ответа');
            $table->string('error_code')->nullable()->comment('Код ошибки');
            $table->string('error_message')->nullable()->comment('Сообщение об ошибке');
            $table->string('temporary_code')->nullable()->comment('Код временного состояния');
            $table->string('state_message')->nullable()->comment('Сообщение о состоянии');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goskey_queue_messages');
    }
};
