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
            <input type="text" name="name" class="form-elem__field"  value="{{ $item->name ?? old('name') ?? get_fio_str() }}">
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
            <input type="text" name="phone" class="form-elem__field tel-mask"  value="{{ $item->phone ?? old('phone') ?? auth()->user()->phone }}">
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

    <h3>Информация о проекте</h3>
    <div class="columns-box columns-box--two-col">
        <label class="form-elem">
            <span class="form-elem__caption">
                Наименование проекта
            </span>
            <input type="text" name="project_name" class="form-elem__field"  value="{{ $item->project_name ?? old('project_name') ?? '' }}">
            @error('project_name')
                <span class="form-elem__error-message">{{ $message }}</span>
            @enderror
        </label>

        <label class="form-elem">
            <span class="form-elem__caption">
                Кадастровый номер
            </span>
            <input type="text" name="cadastr_number" class="form-elem__field"  value="{{ $item->cadastr_number ?? old('cadastr_number') ?? '' }}">
            @error('cadastr_number')
                <span class="form-elem__error-message">{{ $message }}</span>
            @enderror
        </label>

        <label class="form-elem">
            <span class="form-elem__caption">
                Координаты объекта
            </span>
            <input type="text" name="geo" class="form-elem__field"  value="{{ $item->geo ?? old('geo') ?? '' }}">
            @error('geo')
                <span class="form-elem__error-message">{{ $message }}</span>
            @enderror
        </label>

        <label class="form-elem">
            <span class="form-elem__caption">
                Место нахождения объекта
            </span>
            <input type="text" name="object_place_name" class="form-elem__field"  value="{{ $item->object_place_name ?? old('object_place_name') ?? '' }}">
            @error('object_place_name')
                <span class="form-elem__error-message">{{ $message }}</span>
            @enderror
        </label>
    </div>


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

    <label class="form-elem">
        <span class="form-elem__caption">
            Количество точек подключения<sup>*</sup>
        </span>
        <input type="number" name="point_count" class="form-elem__field"  value="{{ $item->point_count ?? old('point_count') ?? 1 }}">
        @error('point_count')
            <span class="form-elem__error-message">{{ $message }}</span>
        @enderror
    </label>

    <div class="form-elem">
        <span class="form-elem__caption">Категория надежности <sup>*</sup></span>

        <select name="safety_category" class="select-ch select-ch--no-search">
            @foreach (config('resource_data.safety_categoryes') as $key => $value)
                <option @selected(isset($item->safety_category) && ($item->safety_category === $key)) value="{{ $key }}">{{ $key }}</option>
            @endforeach
        </select>

        @error('safety_category')
            <span class="form-elem__error-message">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-elem">
        <h4>Расшифровка</h4>
        <ul>
            @foreach (config('resource_data.safety_categoryes') as $key => $value)
                <li><strong>{{ $key}}</strong> - {{ $value }}</li>
            @endforeach
        </ul>
    </div>

    <h3>Максимальная мощность энергопринимающих устройств</h3>
    <div class="columns-box columns-box--two-col">
        <label class="form-elem">
            <span class="form-elem__caption">
                Мощность (кВт)<sup>*</sup>
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
                Мощность (кВт)<sup>*</sup>
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
                Мощность (кВт)
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

    {{-- <x-tc.time-table :item="$item ?? null"></x-tc.time-table> --}}

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
            <textarea class="form-elem__textarea form-elem__textarea-autoheigth" name="prilogenie" placeholder="Опишите все приложенные документы в свободной форме">{{ $item->prilogenie ?? old('prilogenie') ?? '' }}</textarea>
            @error('prilogenie')
                <span class="form-elem__error-message">{{ $message }}</span>
            @enderror
        </label>
    @endif


    <x-edit-form-elements.main-control :format="$format" :item="$item ?? null" doct="tc" deleteroat="technical_connect_delete" ></x-edit-form-elements.main-control>

</form>

{{-- <x-edit-form-elements.blocked-control :format="$format" :item="$item ?? null"  doct="tc" printroute="technical_connect_print" ></x-edit-form-elements.blocked-control> --}}
