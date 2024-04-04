<div class="contact-card">
    <span class="contact-card__caption">
        {{ $item->organization }}
    </span>
    <ul>
        <li><b>{{ __('Ответственное лицо')}}: </b>
            {{ $item->person }}

            @if ($item->dolgnost)
                - {{ $item->dolgnost }}
            @endif
        </li>
        <li><b>{{ __('Телефон')}}: </b>
            <a href="tel:+7{{phone_format($item->phone)}}">{{ $item->phone }}</a>
            @if ($item->email)
            <b>{{ __('e-mail')}}: </b> <a href="mailto:{{ $item->email }}">{{ $item->email }}</a>
            @endif
        </li>
    </ul>
</div>
