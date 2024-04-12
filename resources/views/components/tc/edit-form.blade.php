<form
    enctype='multipart/form-data'
    @class(['form-project-submission', 'flex-form', 'form_disabled' => isset($item->state) && in_array($item->state,
    config('documents')["tc"]['statuses_noedit'])])
    method="POST"
    @if (isset($item->state) && in_array($item->state, config('documents')["area_get"]['statuses_noedit']))
        inert="inert"
    @endif
    action="{{ ( isset($action) )?$action:"#"  }}" >
    @csrf
    @if (session('drafr_save'))
        <div class="form-status form-status--success">
            {{ session('drafr_save') }}
        </div>
    @endif

    @foreach ($errors->all() as $error)
        <div class="form-status form-status--error">
            {{ $error }}
        </div>
    @endforeach

    <input type="hidden" name="item_id" value="{{ $item->id ?? 0 }}">

    <div class="columns-box columns-box--two-col">
        <label class="form-elem">
            <span class="form-elem__caption">
                Ф.И.О. заявителя<sup>*</sup>
            </span>
            <input type="text" name="name" class="form-elem__field"  value="{{ $item->name ?? old('name') ?? '' }}">
            @error('name')
                <span class="form-elem__error-message">{{ $message }}</span>
            @enderror
        </label>

        <label class="form-elem">
            <span class="form-elem__caption">
                Организация<sup>*</sup>
            </span>
            <input type="text" name="organization" class="form-elem__field"  value="{{ $item->organization ?? old('organization') ?? '' }}">
            @error('organization')
                <span class="form-elem__error-message">{{ $message }}</span>
            @enderror
        </label>

        <label class="form-elem">
            <span class="form-elem__caption">
                Должность<sup>*</sup>
            </span>
            <input type="text" name="dolgnost" class="form-elem__field"  value="{{ $item->dolgnost ?? old('dolgnost') ?? '' }}">
            @error('dolgnost')
                <span class="form-elem__error-message">{{ $message }}</span>
            @enderror
        </label>

        <label class="form-elem">
            <span class="form-elem__caption">
                Телефон<sup>*</sup>
            </span>
            <input type="text" name="phone" class="form-elem__field tel-mask"  value="{{ $item->phone ?? old('phone') ?? '' }}">
            @error('phone')
                <span class="form-elem__error-message">{{ $message }}</span>
            @enderror
        </label>

        <label class="form-elem">
            <span class="form-elem__caption">
                ЕГРЮЛ/ЕГРИП заявителя<sup>*</sup>
            </span>
            <input type="text" name="egrul" class="form-elem__field"  value="{{ $item->egrul ?? old('egrul') ?? '' }}">
            @error('egrul')
                <span class="form-elem__error-message">{{ $message }}</span>
            @enderror
        </label>

        <label class="form-elem">
            <span class="form-elem__caption">
                Вид экономической деятельности заявителя<sup>*</sup>
            </span>
            <input type="text" name="okved" class="form-elem__field"  value="{{ $item->okved ?? old('okved') ?? '' }}">
            @error('okved')
                <span class="form-elem__error-message">{{ $message }}</span>
            @enderror
        </label>
    </div>

    <label class="form-elem">
        <span class="form-elem__caption">
            Адрес заявителя<sup>*</sup>
        </span>
        <textarea class="form-elem__textarea form-elem__textarea-autoheigth" name="adress">{{ $item->adress ?? old('adress') ?? '' }}</textarea>
        @error('adress')
            <span class="form-elem__error-message">{{ $message }}</span>
        @enderror
    </label>

    <h3>Паспортные данные</h3>

    <div class="columns-box columns-box--two-col">
        <label class="form-elem">
            <span class="form-elem__caption">
                Серия<sup>*</sup>
            </span>
            <input type="text" name="pasport_seria" class="form-elem__field"  placeholder="Заявитель" value="{{ $item->pasport_seria ?? old('pasport_seria') ?? '' }}">
            @error('pasport_seria')
                <span class="form-elem__error-message">{{ $message }}</span>
            @enderror
        </label>

        <label class="form-elem">
            <span class="form-elem__caption">
                Номер<sup>*</sup>
            </span>
            <input type="text" name="pasport_number" class="form-elem__field"  placeholder="Заявитель" value="{{ $item->pasport_number ?? old('pasport_number') ?? '' }}">
            @error('pasport_number')
                <span class="form-elem__error-message">{{ $message }}</span>
            @enderror
        </label>

    </div>

    <label class="form-elem">
        <span class="form-elem__caption">
            Выдан<sup>*</sup>
        </span>
        <input type="text" name="pasport_vidan" class="form-elem__field"  value="{{ $item->pasport_vidan ?? old('pasport_vidan') ?? '' }}">
        @error('pasport_vidan')
            <span class="form-elem__error-message">{{ $message }}</span>
        @enderror
    </label>

    <h3>Информация о подключении</h3>

    <label class="form-elem">
        <span class="form-elem__caption">
            Основание для присоединения<sup>*</sup>
        </span>
        <input type="text" name="osnovanie" class="form-elem__field"  value="{{ $item->osnovanie ?? old('osnovanie') ?? '' }}">
        @error('osnovanie')
            <span class="form-elem__error-message">{{ $message }}</span>
        @enderror
    </label>

    <label class="form-elem">
        <span class="form-elem__caption">
            Наименование энергопринимающих устройств<sup>*</sup>
        </span>
        <input type="text" name="ustroistvo" class="form-elem__field"  value="{{ $item->ustroistvo ?? old('ustroistvo') ?? '' }}">
        @error('ustroistvo')
            <span class="form-elem__error-message">{{ $message }}</span>
        @enderror
    </label>

    <label class="form-elem">
        <span class="form-elem__caption">
            Место нахождения энергопринимающих устройств<sup>*</sup>
        </span>
        <input type="text" name="raspologeie" class="form-elem__field"  value="{{ $item->raspologeie ?? old('raspologeie') ?? '' }}">
        @error('raspologeie')
            <span class="form-elem__error-message">{{ $message }}</span>
        @enderror
    </label>

    <h3>Максимальная мощность энергопринимающих устройств</h3>
    <div class="columns-box columns-box--two-col">
        <label class="form-elem">
            <span class="form-elem__caption">
                Мощьность (кВт)<sup>*</sup>
            </span>
            <input type="text" name="pover_prin_devices" class="form-elem__field"  value="{{ $item->pover_prin_devices ?? old('pover_prin_devices') ?? '' }}">
            @error('pover_prin_devices')
                <span class="form-elem__error-message">{{ $message }}</span>
            @enderror
        </label>
        <label class="form-elem">
            <span class="form-elem__caption">
                При напряжении (кВ)<sup>*</sup>
            </span>
            <input type="text" name="napr_prin_devices" class="form-elem__field"  value="{{ $item->napr_prin_devices ?? old('napr_prin_devices') ?? '' }}">
            @error('napr_prin_devices')
                <span class="form-elem__error-message">{{ $message }}</span>
            @enderror
        </label>
    </div>

    <h3>Максимальная мощность присоединяемых энергопринимающих устройств</h3>
    <div class="columns-box columns-box--two-col">
        <label class="form-elem">
            <span class="form-elem__caption">
                Мощьность (кВт)<sup>*</sup>
            </span>
            <input type="text" name="pover_pris_devices" class="form-elem__field"  value="{{ $item->pover_pris_devices ?? old('pover_pris_devices') ?? '' }}">
            @error('pover_pris_devices')
                <span class="form-elem__error-message">{{ $message }}</span>
            @enderror
        </label>
        <label class="form-elem">
            <span class="form-elem__caption">
                При напряжении (кВ)<sup>*</sup>
            </span>
            <input type="text" name="napr_pris_devices" class="form-elem__field"  value="{{ $item->napr_pris_devices ?? old('napr_pris_devices') ?? '' }}">
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
            <input type="text" name="pover_pris_r_devices" class="form-elem__field"  value="{{ $item->pover_pris_r_devices ?? old('pover_pris_r_devices') ?? '' }}">
            @error('pover_pris_r_devices')
                <span class="form-elem__error-message">{{ $message }}</span>
            @enderror
        </label>
        <label class="form-elem">
            <span class="form-elem__caption">
                При напряжении (кВ)
            </span>
            <input type="text" name="napr_pris_r_devices" class="form-elem__field"  value="{{ $item->napr_pris_r_devices ?? old('napr_pris_r_devices') ?? '' }}">
            @error('napr_pris_r_devices')
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
            Гарантирующий поставщик<sup>*</sup>
        </span>
        <input type="text" name="gen_postavhik" class="form-elem__field"  value="{{ $item->gen_postavhik ?? old('gen_postavhik') ?? '' }}">
        @error('gen_postavhik')
            <span class="form-elem__error-message">{{ $message }}</span>
        @enderror
    </label>

    @if ($format !== "create" )
        <h3>Приложения</h3>
        @if ($item->attachment)
            <div class="attachment-files-box">
                @foreach ($item->attachment as $file)
                    <div class="attachment-file">
                            <a href="{{ Storage::url($file->storage_patch."/".$file->file)}}" class="attachment-file__name"> {{ $file->file_real }}</a>
                            <button class="attachment-file__btn close-icon" type="submit" title="Удалить вложение" name="att_delete" value="{{ $file->id }}"> </button>
                    </div>
                @endforeach
            </div>
        @endif


        <div class="file-funnel">
            <input type="file" name="attachment[]" class="file-funnel__file-input" multiple="multiple">
            <div class="file-funnel__text">
                <span class="file-funnel__caption">
                    Загрузить файлы
                </span>
                <span class="file-funnel__direction">
                    В форматах doc, docx, pdf, jpg, png
                </span>
            </div>
            <div class="file-funnel__receiver">
                +
            </div>
            <div class="file-funnel__docs">
                <button type="button" class="file-funnel-btn file-funnel-btn--reset">Очистить</button>
            </div>
        </div>

        <label class="form-elem">
            <span class="form-elem__caption">
                Приложения к заявлению
            </span>
            <textarea class="form-elem__textarea form-elem__textarea-autoheigth" name="prilogenie" placeholder="Опишите все приложенные документы в свободной форме"  value="{{ $item->prilogenie ?? old('prilogenie') ?? '' }}"></textarea>
            @error('prilogenie')
                <span class="form-elem__error-message">{{ $message }}</span>
            @enderror
        </label>
    @endif


    <x-edit-form-elements.main-control :format="$format" :item="$item ?? null" doct="tc" deleteroat="technical_connect_delete" ></x-edit-form-elements.main-control>

</form>

<x-edit-form-elements.blocked-control :format="$format" :item="$item ?? null"  doct="tc" printroute="technical_connect_print" ></x-edit-form-elements.blocked-control>
