<div class="pseudotable__tr">
    <div class="pseudotable-td">
        <label class="form-elem">
            <span class="form-elem__caption">
                Этап
            </span>
            <input type="text"  class="form-elem__field" name="et_{{$index}}" value="{{ $fields['et'] ?? old('et_'.$index) ?? '' }}">
        </label>
    </div>
    <div class="pseudotable-td">
        <label class="form-elem">
            <span class="form-elem__caption">
                Планируемый срок проектирования
            </span>
            <input type="text" class="form-elem__field" name="pproject_{{$index}}" value="{{ $fields['pproject'] ?? old('pproject_'.$index) ?? '' }}">

        </label>
    </div>
    <div class="pseudotable-td">
        <label class="form-elem">
            <span class="form-elem__caption">
                Планируемый срок введения в эксплуатацию
            </span>
            <input type="text" class="form-elem__field" name="pexpl_{{$index}}" value="{{ $fields['pexpl'] ?? old('pexpl_'.$index) ?? '' }}">
        </label>
    </div>
    <div class="pseudotable-td">
        <label class="form-elem">
            <span class="form-elem__caption">
                Максимальная мощность устройств
            </span>
            <input type="text" class="form-elem__field" name="maxp_{{$index}}" value="{{ $fields['maxp'] ?? old('maxp_'.$index) ?? '' }}">
        </label>
    </div>
    <div class="pseudotable-td">
        <label class="form-elem">
            <span class="form-elem__caption">
                Категория надежности устройств
            </span>
            <input type="text" class="form-elem__field" name="cat_{{$index}}" value="{{ $fields['cat'] ?? old('cat_'.$index) ?? '' }}">

        </label>
    </div>
</div>
