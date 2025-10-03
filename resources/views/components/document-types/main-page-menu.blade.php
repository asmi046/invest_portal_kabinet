@foreach ($documentTypes as $item)
    <x-widget-icon-lnk lnk="{{ $item->index_url }}" title="{{ $item->short_name ?? $item->name }}" icon="{{ $item->icon }}"></x-widget-icon-lnk>
@endforeach
