@props([
    'list' => [
        'Заявитель' => "applicant_name",
        'Объект' => "object_name",
    ],
    'elements' => null,
    'documentType' => null,
])


@if (isset($elements) && $elements->count() > 0)

    <div class="table-box">
        <table class="w-table applications-table">
            <thead>
                <tr>
                    <th>ID</th>
                    @foreach ($list as $key => $value)
                        <th>{{ $key }}</th>
                    @endforeach
                    <th>Подпись</th>
                    <th>Тип подписи</th>
                    <th>Статус</th>
                    <th>Управление</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($elements as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        @foreach ($list as $key => $value)
                            <td>{{ $item->$value }}</td>
                        @endforeach

                        <td>
                            <x-document-table.sign-cell :item="$item"></x-document-table.sign-cell>
                        </td>
                        <td>
                            <x-document-table.sign-type-cell :item="$item"></x-document-table.sign-type-cell>
                        </td>
                        <td>{{ $item->state }}</td>
                        <td>
                            <x-document-table.control-cell :item="$item" :document-type="$documentType"></x-document-table.control-cell>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <h2>У вас еще нет заявлений</h2>
    <a href="{{ $documentType->create_url }}" class="button">Создать заявление</a>
@endif
