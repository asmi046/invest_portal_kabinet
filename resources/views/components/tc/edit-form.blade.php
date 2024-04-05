<form class="form-project-submission flex-form" method="POST" action="{{ ( isset($action) )?$action:"#"  }}">
    @csrf
    @if (session('drafr_save'))
        <p class="success">{{ session('drafr_save') }}</p>
    @endif

    <input type="hidden" name="item_id" value="{{ $item->id ?? 0 }}">

    <div class="columns-box columns-box--two-col">
        <label class="form-elem">
            <span class="form-elem__caption">
                Ф.И.О. заявителя<span class="required">*</span>
            </span>
            <input type="text" name="name" class="form-elem__field"  value="{{ $item->name ?? '' }}">
            @error('name')
                <span class="form-elem__error-message">{{ $message }}</span>
            @enderror
        </label>

        <label class="form-elem">
            <span class="form-elem__caption">
                Организация<span class="required">*</span>
            </span>
            <input type="text" name="organization" class="form-elem__field"  value="{{ $item->organization ?? '' }}">
            @error('organization')
                <span class="form-elem__error-message">{{ $message }}</span>
            @enderror
        </label>

        <label class="form-elem">
            <span class="form-elem__caption">
                Должность<span class="required">*</span>
            </span>
            <input type="text" name="dolgnost" class="form-elem__field"  value="{{ $item->dolgnost ?? '' }}">
            @error('dolgnost')
                <span class="form-elem__error-message">{{ $message }}</span>
            @enderror
        </label>

        <label class="form-elem">
            <span class="form-elem__caption">
                Телефон<span class="required">*</span>
            </span>
            <input type="text" name="phone" class="form-elem__field tel-mask"  value="{{ $item->phone ?? '' }}">
            @error('phone')
                <span class="form-elem__error-message">{{ $message }}</span>
            @enderror
        </label>
    </div>

    <label class="form-elem">
        <span class="form-elem__caption">
            ЕГРЮЛ/ЕГРИП заявителя<span class="required">*</span>
        </span>
        <input type="text" name="egrul" class="form-elem__field"  value="{{ $item->egrul ?? '' }}">
        @error('egrul')
            <span class="form-elem__error-message">{{ $message }}</span>
        @enderror
    </label>

    <label class="form-elem">
        <span class="form-elem__caption">
            Адрес заявителя<span class="required">*</span>
        </span>
        <textarea class="form-elem__textarea form-elem__textarea-autoheigth" name="adress">{{ $item->adress ?? '' }}</textarea>
        @error('adress')
            <span class="form-elem__error-message">{{ $message }}</span>
        @enderror
    </label>

    <h3>Паспортные данные</h3>

    <div class="columns-box columns-box--two-col">
        <label class="form-elem">
            <span class="form-elem__caption">
                Серия<span class="required">*</span>
            </span>
            <input type="text" name="pasport_seria" class="form-elem__field"  placeholder="Заявитель" value="{{ $item->pasport_seria ?? '' }}">
            @error('pasport_seria')
                <span class="form-elem__error-message">{{ $message }}</span>
            @enderror
        </label>

        <label class="form-elem">
            <span class="form-elem__caption">
                Номер<span class="required">*</span>
            </span>
            <input type="text" name="pasport_number" class="form-elem__field"  placeholder="Заявитель" value="{{ $item->pasport_number ?? '' }}">
            @error('pasport_number')
                <span class="form-elem__error-message">{{ $message }}</span>
            @enderror
        </label>

    </div>

    <label class="form-elem">
        <span class="form-elem__caption">
            Выдан<span class="required">*</span>
        </span>
        <input type="text" name="pasport_vidan" class="form-elem__field"  value="{{ $item->pasport_vidan ?? '' }}">
        @error('pasport_vidan')
            <span class="form-elem__error-message">{{ $message }}</span>
        @enderror
    </label>

    <h3>Информация о подключении</h3>

    <label class="form-elem">
        <span class="form-elem__caption">
            Основание для присоединения<span class="required">*</span>
        </span>
        <input type="text" name="osnovanie" class="form-elem__field"  value="{{ $item->osnovanie ?? '' }}">
        @error('osnovanie')
            <span class="form-elem__error-message">{{ $message }}</span>
        @enderror
    </label>

    <label class="form-elem">
        <span class="form-elem__caption">
            Наименование энергопринимающих устройств<span class="required">*</span>
        </span>
        <input type="text" name="ustroistvo" class="form-elem__field"  value="{{ $item->ustroistvo ?? '' }}">
        @error('ustroistvo')
            <span class="form-elem__error-message">{{ $message }}</span>
        @enderror
    </label>

    <label class="form-elem">
        <span class="form-elem__caption">
            Место нахождения энергопринимающих устройств<span class="required">*</span>
        </span>
        <input type="text" name="raspologeie" class="form-elem__field"  value="{{ $item->raspologeie ?? '' }}">
        @error('raspologeie')
            <span class="form-elem__error-message">{{ $message }}</span>
        @enderror
    </label>

    <h3>Максимальная мощность энергопринимающих устройств</h3>
    <div class="columns-box columns-box--two-col">
        <label class="form-elem">
            <span class="form-elem__caption">
                Мощьность (кВт)<span class="required">*</span>
            </span>
            <input type="text" name="pover_prin_devices" class="form-elem__field"  value="{{ $item->pover_prin_devices ?? '' }}">
            @error('pover_prin_devices')
                <span class="form-elem__error-message">{{ $message }}</span>
            @enderror
        </label>
        <label class="form-elem">
            <span class="form-elem__caption">
                При напряжении (кВ)<span class="required">*</span>
            </span>
            <input type="text" name="napr_prin_devices" class="form-elem__field"  value="{{ $item->napr_prin_devices ?? '' }}">
            @error('napr_prin_devices')
                <span class="form-elem__error-message">{{ $message }}</span>
            @enderror
        </label>
    </div>

    <h3>Максимальная мощность присоединяемых энергопринимающих устройств</h3>
    <div class="columns-box columns-box--two-col">
        <label class="form-elem">
            <span class="form-elem__caption">
                Мощьность (кВт)<span class="required">*</span>
            </span>
            <input type="text" name="pover_pris_devices" class="form-elem__field"  value="{{ $item->pover_pris_devices ?? '' }}">
            @error('pover_pris_devices')
                <span class="form-elem__error-message">{{ $message }}</span>
            @enderror
        </label>
        <label class="form-elem">
            <span class="form-elem__caption">
                При напряжении (кВ)<span class="required">*</span>
            </span>
            <input type="text" name="napr_pris_devices" class="form-elem__field"  value="{{ $item->napr_pris_devices ?? '' }}">
            @error('napr_pris_devices')
                <span class="form-elem__error-message">{{ $message }}</span>
            @enderror
        </label>
    </div>

    <h3>Максимальная мощность ранее присоединенных в данной точке</h3>
    <div class="columns-box columns-box--two-col">
        <label class="form-elem">
            <span class="form-elem__caption">
                Мощьность (кВт)
            </span>
            <input type="text" name="pover_pris_r_devices" class="form-elem__field"  value="{{ $item->pover_pris_r_devices ?? '' }}">
            @error('pover_pris_r_devices')
                <span class="form-elem__error-message">{{ $message }}</span>
            @enderror
        </label>
        <label class="form-elem">
            <span class="form-elem__caption">
                При напряжении (кВ)
            </span>
            <input type="text" name="napr_pris_r_devices" class="form-elem__field"  value="{{ $item->napr_pris_r_devices ?? '' }}">
            @error('napr_pris_devices')
                <span class="form-elem__error-message">{{ $message }}</span>
            @enderror
        </label>
    </div>

    <h3>Информация об оплате</h3>
    <div class="form-elem">
        <span class="form-elem__caption">Выпадающий список с одиночным выбором <sup>*</sup></span>
        <select name="gender" class="select-ch select-ch--no-search">
            <option value="">Не выбрано</option>
            <option @selected(isset($item->rashet_plati) && ($item->rashet_plati === 'Вариант 1')) value="Вариант 1">Вариант 1</option>
            <option @selected(isset($item->rashet_plati) && ($item->rashet_plati === 'Вариант 2')) value="Вариант 2">Вариант 2</option>
        </select>
        @error('rashet_plati')
            <span class="form-elem__error-message">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-elem form-elem-choices--no-placeholder">
        <span class="form-elem__caption">Выпадающий список с одиночным выбором с полем поиска</span>
        <select name="gender" class="select-ch" >
            <option value="">Не выбрано</option>
            <option @selected(isset($item->rashet_plati) && ($item->rashet_plati === 'Вариант 1')) value="Вариант 1">Вариант 1</option>
            <option @selected(isset($item->rashet_plati) && ($item->rashet_plati === 'Вариант 2')) value="Вариант 2">Вариант 2</option>
        </select>
        @error('rashet_plati')
            <span class="form-elem__error-message">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-elem">
        <span class="form-elem__caption">Выпадающий список с множественным выбором без плейсхолдера да еще и с полем поиска</span>
        <select name="gender" class="select-ch" multiple="multiple">
            <option value="">Не выбрано</option>
            <option value="1">Субсидии на возмещение части затрат на уплату процентов по кредитам, привлекаемым инвесторами в кредитных организациях, а также субсидии по лизинговым платежам</option>
            <option value="2">Государственные гарантии по инвестиционным проектам за счет средств областного бюджета</option>
            <option value="3">Обеспечение обязательств инвесторов перед кредитными организациями в форме предоставления в залог имущества и имущественных прав Курской области по привлекаемым кредитам на реализацию инвестиционных проектов, в том числе на осуществление лизинговых платежей за оборудование, приобретаемое по лизингу на условиях последующего выкупа данного оборудования для реализации инвестиционных проектов</option>
            <option value="4">Инвестиционный налоговый кредит</option>
            <option value="5">Снижение налоговой ставки налога на прибыль организаций, подлежащего зачислению в областной бюджет, с 18 до 13,5 процентов (при реализации инвестиционного проекта с суммой инвестиций в основной капитал более 100 млн. руб. с НДС)</option>
            <option value="5">Освобождение от уплаты налога на имущество организаций (при реализации инвестиционного проекта с суммой инвестиций в основной капитал более 100 млн. руб. с НДС)</option>
        </select>
        @error('rashet_plati')
            <span class="form-elem__error-message">{{ $message }}</span>
        @enderror
    </div>


    <label class="form-elem">
        <span class="form-elem__caption">
            Порядок расчета и условия рассрочки внесения платы<span class="required">*</span>
        </span>
        <select name="rashet_plati" class="form-elem__field" id="">
            <option @selected(isset($item->rashet_plati) && ($item->rashet_plati === 'Вариант 1')) value="Вариант 1">Вариант 1</option>
            <option @selected(isset($item->rashet_plati) && ($item->rashet_plati === 'Вариант 2')) value="Вариант 2">Вариант 2</option>
        </select>
        @error('rashet_plati')
            <span class="form-elem__error-message">{{ $message }}</span>
        @enderror
    </label>

    <label class="form-elem">
        <span class="form-elem__caption">
            Гарантирующий поставщик<span class="required">*</span>
        </span>
        <input type="text" name="gen_postavhik" class="form-elem__field"  value="{{ $item->gen_postavhik ?? '' }}">
        @error('gen_postavhik')
            <span class="form-elem__error-message">{{ $message }}</span>
        @enderror
    </label>

    <h3>Приложения</h3>

    <label class="form-elem">
        <span class="form-elem__caption">
            Приложения к заявлению
        </span>
        <textarea class="form-elem__textarea form-elem__textarea-autoheigth" name="prilogenie" placeholder="Опишите все приложенныедокументы в свободной форме"  value="{{ $item->prilogenie ?? '' }}"></textarea>
        @error('prilogenie')
            <span class="form-elem__error-message">{{ $message }}</span>
        @enderror
    </label>


    <div class="form-control-panel">
        @if ($format == "create")
            <button type="submit" class="btn" title="Сохранить черновик" name="action" value="create_draft"> <span class="save-icon"></span>Сохранить черновик</button>
        @else
            <button type="submit" class="btn" title="Сохранить черновик" name="action" value="save_draft"> <span class="save-icon"></span>Сохранить черновик</button>
            <button type="submit" class="btn" title="Проверить и подписать" name="action" value="validate_signe"> <span class="save-icon"></span>Проверить и подписать</button>
            <a
            class="btn"
            onclick="if (!confirm('Черновик будет удален навсегда! Вы уверенны?')) return false;"
            href="{{ route('technical_connect_delete', $item->id) }}"
            >Удалить</a>
        @endif

    </div>

</form>
