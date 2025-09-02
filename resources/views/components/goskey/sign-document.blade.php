<div class="btn-link goskey_sign_page">
    <div @class(['wrapper-icon', 'no_active' => !$signActive])>
        <img src="{{ asset('img/goskey-vertical-logo.svg') }}" alt="">
    </div>
    <div class="wrapper-control">
        @if (!$signActive)
            <p>{!! $message !!}</p>
        @endif

        @if ($signActive)
            <div id="goskey_app" class="goskey_app">
                <goskey-sign-panel
                    :model="'{{ addslashes($document->document_type) }}'"
                    :document-id="{{ $document->id }}"
                />
            </div>
        @endif
    </div>
</div>
