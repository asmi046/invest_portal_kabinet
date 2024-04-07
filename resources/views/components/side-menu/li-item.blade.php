<li @class([$icon, 'active' => isset($find)?in_array(Route::currentRouteName(), $find):false]) >
    <a href="{{ $route }}">{{ $title }}</a>
</li>
