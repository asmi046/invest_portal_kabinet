@if ($item && $item[$param])
        <p><strong>{{$name}}:</strong></p>
        <input type="hidden" name="{{$param}}" value="{{ $item[$param] }}">
        <div class="attachment-files-box">
                <div class="attachment-file">
                        <a href="{{ Storage::url("tc_doc/".$item[$param])}}" class="attachment-file__name"> {{ $item[$param] }}</a>
                        <button class="attachment-file__btn close-icon" type="submit" title="Удалить вложение" name="action" value="delete_{{$param}}"> </button>
                </div>
        </div>
@else
    <div class="file-funnel">
        <input type="file" name="{{ $param }}" class="file-funnel__file-input" multiple="multiple">
        <div class="file-funnel__text">
            <span class="file-funnel__caption">
                Загрузить:<br>
                {{$name}}
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
@endif
