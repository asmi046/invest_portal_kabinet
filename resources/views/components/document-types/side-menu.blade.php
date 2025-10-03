@foreach ($documentTypes as $item)
    <li @class(['active-parent' => stripos(Route::currentRouteName(), str_replace('/', '', $item->index_url)) !== false])>
        <div class="main-menu__parent-panel">
            <span>{{ $item->short_name ?? $item->name }}</span>
            <button class="main-menu__arrow"></button>
        </div>
        <ul>
            <x-side-menu.li-item :find="['projects']" icon="doc-icon" :route="$item->index_url" title="Все"></x-side-menu.li-item>
            <x-side-menu.li-item :find="['project_create']" icon="pencil-icon" :route="$item->create_url" title="Создать"></x-side-menu.li-item>
        </ul>
    </li>
@endforeach
