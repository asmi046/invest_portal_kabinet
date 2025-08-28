<div class="btn-link goskey_sign_page">
    <div @class(['wrapper-icon', 'no_active' => !$signActive])>
        <img src="{{ asset('img/goskey-vertical-logo.svg') }}" alt="">
    </div>
    <div class="wrapper-control">
        <p>{!! $message !!}</p>
        @if ($signActive)
            <div class="btn-link__actions">
                <a href="#" class="btn">Подписать как физлицо</a>
                <a href="#" class="btn">Подписать как юридическое лицо</a>
            </div>
        @endif
    </div>
</div>
