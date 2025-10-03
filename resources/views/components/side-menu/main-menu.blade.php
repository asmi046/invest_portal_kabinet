<nav>
    <menu class="main-menu">
        <x-document-types.side-menu></x-document-types.side-menu>
        {{-- <li @class(['active-parent' => stripos(Route::currentRouteName(), "project") !== false])>
            <div class="main-menu__parent-panel">
                <span>Инвестиционные проекты</span>
                <button class="main-menu__arrow"></button>
            </div>
            <ul>
                <x-side-menu.li-item :find="['projects']" icon="doc-icon" :route="route('projects')" title="Все проекты"></x-side-menu.li-item>
                <x-side-menu.li-item :find="['project_create']" icon="pencil-icon" :route="route('project_create')" title="Подать проект"></x-side-menu.li-item-one>
            </ul>
        </li>

        <li @class(['active-parent' => stripos(Route::currentRouteName(), "support") !== false])>
            <div class="main-menu__parent-panel">
                <span>Заявления на государственную поддержку</span>
                <button class="main-menu__arrow"></button>
            </div>
            <ul>
                <x-side-menu.li-item :find="['support']" icon="doc-icon" :route="route('support')" title="Все заявления"></x-side-menu.li-item>
                <x-side-menu.li-item :find="['support_create']" icon="pencil-icon" :route="route('support_create')" title="Подать заявление"></x-side-menu.li-item-one>
                <x-side-menu.li-item  icon="handshake-icon" route="https://navigator-mp.kursk.ru/" title="Меры поддержки"></x-side-menu.li-item>
            </ul>
        </li>

        <li @class(['active-parent' => stripos(Route::currentRouteName(), "area_get") !== false])>
            <div class="main-menu__parent-panel">
                <span>Заявления на предоставление земельного участка</span>
                <button class="main-menu__arrow"></button>
            </div>
            <ul>
                <x-side-menu.li-item :find="['area_get', 'area_get_edit', 'area_get_status']" icon="doc-icon" :route="route('area_get')" title="Все заявления"></x-side-menu.li-item>
                <x-side-menu.li-item :find="['area_get_create']" icon="pencil-icon" :route="route('area_get_create')" title="Подать заявление"></x-side-menu.li-item-one>
            </ul>
        </li>

        <li @class(['active-parent' => stripos(Route::currentRouteName(), "technical_connect") !== false])>
            <div class="main-menu__parent-panel">
                <span>Заявления на технологическое присоединение</span>
                <button class="main-menu__arrow"></button>
            </div>
            <ul >
                <x-side-menu.li-item icon="doc-icon" :find="['technical_connect', 'technical_connect_edit', 'technical_connect_status']" :route="route('technical_connect')" title="Все заявления"></x-side-menu.li-item>
                <x-side-menu.li-item icon="pencil-icon" :find="['technical_connect_create']"  :route="route('technical_connect_create')" title="Подать заявку на технологическое присоединение"></x-side-menu.li-item>
            </ul>
        </li>

        <li @class(['active-parent' => stripos(Route::currentRouteName(), "information") !== false])>
            <div class="main-menu__parent-panel">
                <span>Информация для инвестора</span>
                <button class="main-menu__arrow"></button>
            </div>
            <ul >
                <x-side-menu.li-item icon="list-icon" :find="['information_algoritm']" :route="route('information_algoritm')" title="Алгоритмы действий инвестора по технологическому присоединению"></x-side-menu.li-item>
                <x-side-menu.li-item icon="bagdoc-icon" :find="['information_org_list']" :route="route('information_org_list')" title="Список ресурсоснабжающих организаций"></x-side-menu.li-item>
            </ul>
        </li> --}}
    </menu>
</nav>
