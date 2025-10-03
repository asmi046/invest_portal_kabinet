<li @class([$icon, 'active' => (request()->url() == url($route))?true:false]) >
    <a href="{{ $route }}">{{ $title }}</a>
</li>
