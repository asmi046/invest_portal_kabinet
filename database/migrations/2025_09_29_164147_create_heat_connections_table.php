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
            $table->string('state')->comment("Статус документа");



            $table->string('supplier_org', 500)->nullable()->comment('Наименование уполномоченного на выдачу разрешений на ввод объекта в эксплуатацию федерального органа исполнительной власти');

            // Организация Заявитель
            $table->string('applicant_name', 256)->nullable()->comment('Наименование заявителя');
            $table->string('applicant_address_ur', 256)->nullable()->comment('Юридический адрес заявителя');
            $table->string('applicant_address_post', 256)->nullable()->comment('Почтовый адрес заявителя');
            $table->string('applicant_phone', 256)->nullable()->comment('Телефон заявителя');
            $table->string('applicant_bank_name', 256)->nullable()->comment('Наименование банка заявителя');
            $table->string('applicant_bank_rs', 256)->nullable()->comment('Расчетный счет банка заявителя');
            $table->string('applicant_bank_ks', 256)->nullable()->comment('Корреспондентский счет банка заявителя');
            $table->string('applicant_bank_bik', 256)->nullable()->comment('БИК банка заявителя');
            $table->string('applicant_ogrn', 256)->nullable()->comment('ОГРН / ОГРНИП');
            $table->string('applicant_inn_kpp', 256)->nullable()->comment('ИНН');


            // Объект
            $table->string('object_name')->nullable()->comment('Наименование объекта ');
            $table->string('object_address')->nullable()->comment('Адрес (местоположение) объекта');


            $table->double('teplovaya_nagruzka_vsego_chasovaya_maksimalnaya')->default(0)->comment('Тепловая нагрузка, Гкал/ч всего часовая — максимальная');
            $table->double('teplovaya_nagruzka_vsego_chasovaya_minimalnaya')->default(0)->comment('Тепловая нагрузка, Гкал/ч всего часовая — минимальная');
            $table->double('teplovaya_nagruzka_vsego_srednechasovaya_maksimalnaya')->default(0)->comment('Тепловая нагрузка, Гкал/ч всего среднечасовая — максимальная');
            $table->double('teplovaya_nagruzka_vsego_srednechasovaya_minimalnaya')->default(0)->comment('Тепловая нагрузка, Гкал/ч всего среднечасовая — минимальная');
            $table->double('raskhod_teplonositelya_vsego_rashetnyi')->default(0)->comment('Расход теплоносителя, т/ч — всего расчетный');
            $table->double('raskhod_teplonositelya_vsego_srednechasovoy')->default(0)->comment('Расход теплоносителя, т/ч — всего среднечасовой');

            $table->double('teplovaya_nagruzka_otoplenie_chasovaya_maksimalnaya')->default(0)->comment('Тепловая нагрузка, Гкал/ч отопление часовая — максимальная');
            $table->double('teplovaya_nagruzka_otoplenie_chasovaya_minimalnaya')->default(0)->comment('Тепловая нагрузка, Гкал/ч отопление часовая — минимальная');
            $table->double('teplovaya_nagruzka_otoplenie_srednechasovaya_maksimalnaya')->default(0)->comment('Тепловая нагрузка, Гкал/ч отопление среднечасовая — максимальная');
            $table->double('teplovaya_nagruzka_otoplenie_srednechasovaya_minimalnaya')->default(0)->comment('Тепловая нагрузка, Гкал/ч отопление среднечасовая — минимальная');
            $table->double('raskhod_teplonositelya_otoplenie_rashetnyi')->default(0)->comment('Расход теплоносителя, т/ч — отопление расчетный');
            $table->double('raskhod_teplonositelya_otoplenie_srednechasovoy')->default(0)->comment('Расход теплоносителя, т/ч — отопление среднечасовой');

            $table->double('teplovaya_nagruzka_ventilyatsia_chasovaya_maksimalnaya')->default(0)->comment('Тепловая нагрузка, Гкал/ч вентиляция часовая — максимальная');
            $table->double('teplovaya_nagruzka_ventilyatsia_chasovaya_minimalnaya')->default(0)->comment('Тепловая нагрузка, Гкал/ч вентиляция часовая — минимальная');
            $table->double('teplovaya_nagruzka_ventilyatsia_srednechasovaya_maksimalnaya')->default(0)->comment('Тепловая нагрузка, Гкал/ч вентиляция среднечасовая — максимальная');
            $table->double('teplovaya_nagruzka_ventilyatsia_srednechasovaya_minimalnaya')->default(0)->comment('Тепловая нагрузка, Гкал/ч вентиляция среднечасовая — минимальная');
            $table->double('raskhod_teplonositelya_ventilyatsia_rashetnyi')->default(0)->comment('Расход теплоносителя, т/ч — вентиляция расчетный');
            $table->double('raskhod_teplonositelya_ventilyatsia_srednechasovoy')->default(0)->comment('Расход теплоносителя, т/ч — вентиляция среднечасовой');

            $table->double('teplovaya_nagruzka_gorvoda_chasovaya_maksimalnaya')->default(0)->comment('Тепловая нагрузка, Гкал/ч горячее водоснабжение часовая — максимальная');
            $table->double('teplovaya_nagruzka_gorvoda_chasovaya_minimalnaya')->default(0)->comment('Тепловая нагрузка, Гкал/ч горячее водоснабжение часовая — минимальная');
            $table->double('teplovaya_nagruzka_gorvoda_srednechasovaya_maksimalnaya')->default(0)->comment('Тепловая нагрузка, Гкал/ч горячее водоснабжение среднечасовая — максимальная');
            $table->double('teplovaya_nagruzka_gorvoda_srednechasovaya_minimalnaya')->default(0)->comment('Тепловая нагрузка, Гкал/ч горячее водоснабжение среднечасовая — минимальная');
            $table->double('raskhod_teplonositelya_gorvoda_rashetnyi')->default(0)->comment('Расход теплоносителя, т/ч — горячее водоснабжение расчетный');
            $table->double('raskhod_teplonositelya_gorvoda_srednechasovoy')->default(0)->comment('Расход теплоносителя, т/ч — горячее водоснабжение среднечасовой');

            // Параметры теплоносителя
            $table->decimal('heat_pressure', 10, 2)->nullable()->comment('Давление теплоносителя, м вод. ст');
            $table->decimal('heat_temperature', 5, 2)->nullable()->comment('Температура теплоносителя, °C');
            $table->boolean('has_meter_control')->default(false)->comment('Наличие узла учета тепловой энергии и теплоносителя');
            $table->string('consumption_mode', 20)->nullable()->comment('Режим потребления (постоянный, переменный)');
            $table->string('reliability_category', 50)->nullable()->comment('Категория надежности');
            $table->boolean('has_own_source')->default(false)->comment('Наличие собственной источника тепловой энергии');
            $table->integer('commissioning_year')->nullable()->comment('Год ввода в эксплуатацию');
            $table->string('land_usage_info', 256)->nullable()->comment('Информация о виде разрешенного использования земельного участка');
            $table->string('construction_limits', 256)->nullable()->comment('Информация о предельных параметрах разрешённого строительства');

            // Приложения
            $table->integer('attachments_list')->nullable()->comment('Количество приложенных листов');
            $table->integer('attachments_ekz')->nullable()->comment('Количество экземпляров');

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
