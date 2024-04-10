<form
    enctype='multipart/form-data'
    @class(['form-project-submission', 'flex-form', 'form_disabled' => isset($item->state) && in_array($item->state,
    config('documents')["tc"]['statuses_noedit'])])
    method="POST"
    action="{{ ( isset($action) )?$action:"#"  }}">
    @csrf

    @if (session('drafr_save'))
        <p class="success">{{ session('drafr_save') }}</p>
    @endif

    @foreach ($errors->all() as $error)
        <p class="error">{{ $error }}</p>
    @endforeach

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
                Вид экономической деятельности заявителя<span class="required">*</span>
            </span>
            <input type="text" name="okved" class="form-elem__field"  value="{{ $item->okved ?? '' }}">
            @error('okved')
                <span class="form-elem__error-message">{{ $message }}</span>
            @enderror
        </label>
    </div>

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

    <x-tc.time-table :item="$item ?? null"></x-tc.time-table>

    <h3>Информация об оплате</h3>
    <div class="form-elem">
        <span class="form-elem__caption">Порядок расчета и условия рассрочки внесения платы <sup>*</sup></span>
        <select name="rashet_plati" class="select-ch select-ch--no-search">
            <option value="">Не выбрано</option>
            <option @selected(isset($item->rashet_plati) && ($item->rashet_plati === 'Вариант 1')) value="Вариант 1">Вариант 1</option>
            <option @selected(isset($item->rashet_plati) && ($item->rashet_plati === 'Вариант 2')) value="Вариант 2">Вариант 2</option>
        </select>
        @error('rashet_plati')
            <span class="form-elem__error-message">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-element">
        <div class="columns-box columns-box--two-col">
            <div class="variant_1">
                <h4>Вариант 1</h4>
                <ul>
                    <li>15 процентов платы за технологическое присоединение вносятся в течение 15 дней со дня заключения договора;</li>
                    <li>30 процентов платы за технологическое присоединение вносятся в течение 60 дней со дня заключения договора, но не позже дня фактического присоединения;</li>
                    <li>45 процентов платы за технологическое присоединение вносятся в течение 15 дней со дня фактического присоединения;</li>
                    <li>10 процентов платы за технологическое присоединение вносятся в течение 15 дней со дня подписания акта об осуществлении технологического присоединения;</li>
                </ul>
            </div>
            <div class="variant_2">
                <h4>Вариант 2</h4>
                <ul>
                    <li>авансовый платеж вносится в размере 5 процентов размера платы за технологическое присоединение;</li>
                    <li>осуществляется беспроцентная рассрочка платежа в размере 95 процентов платы за технологическое присоединение с условием ежеквартального внесения платы равными долями от общей суммы рассрочки на период до 3 лет со дня подписания сторонами акта об осуществлении технологического присоединения.</li>
                </ul>
            </div>
        </div>
    </div>

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
            @if (!in_array($item->state, config('documents')["area_get"]['statuses_noedit']))
                <button type="submit" class="btn" title="Сохранить черновик" name="action" value="save_draft"> <span class="save-icon"></span>Сохранить черновик</button>
                <button type="submit" class="btn" title="Проверить и подписать" name="action" value="validate_signe"> <span class="save-icon"></span>Проверить и подписать</button>
                <a href="{{route('technical_connect_print', $item->id)}}" class="btn" title="Печатная форма"> <span class="save-icon"></span>Печатная форма</a>
                <a
                class="btn mlAuto"
                onclick="if (!confirm('Черновик будет удален навсегда! Вы уверенны?')) return false;"
                href="{{ route('technical_connect_delete', $item->id) }}"
                >Удалить</a>
            @else
                <a href="{{route('technical_connect_print', $item->id)}}" class="btn" title="Печатная форма"> <span class="save-icon"></span>Печатная форма</a>
            @endif
        @endif

    </div>

</form>
