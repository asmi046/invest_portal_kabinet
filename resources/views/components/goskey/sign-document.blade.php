<div class="btn-link goskey_sign_page">
    <div @class(['wrapper-icon', 'no_active' => !$signActive])>
        <img src="{{ asset('img/goskey-vertical-logo.svg') }}" alt="">
    </div>
    <div class="wrapper-control">
        @if (!$signActive || $signProcess)
            <p>{!! $message !!}</p>
        @endif


            <div id="goskey_app" class="goskey_app">
                @if ($signActive && !$signProcess)
                    <goskey-sign-panel
                        :model="'{{ addslashes($document->document_type) }}'"
                        :document-id="{{ $document->id }}"
                    />
                @endif
            </div>

    </div>
</div>
