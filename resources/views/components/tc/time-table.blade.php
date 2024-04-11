<h2>Сроки проектирования</h2>
<table>
    <thead>
        <tr>
            <th>Этап</th>
            <th>Планируемый срок проектирования</th>
            <th>Планируемый срок введения в эксплуатацию</th>
            <th>Максимальная мощьность устройств</th>
            <th>Категория надежности устройств</th>
        </tr>
    </thead>
    <tbody>
        @if (!empty($item->etaps))
            @php
                $i = 0;
            @endphp
            @foreach ($item->etaps as $fields)
                <tr>
                    <td><input type="text" name="et_{{$i}}" value="{{ $fields['et'] ?? '' }}"></td>
                    <td><input type="text" name="pproject_{{$i}}" value="{{ $fields['pproject'] ?? '' }}"></td>
                    <td><input type="text" name="pexpl_{{$i}}" value="{{ $fields['pexpl'] ?? '' }}"></td>
                    <td><input type="text" name="maxp_{{$i}}" value="{{ $fields['maxp'] ?? '' }}"></td>
                    <td><input type="text" name="cat_{{$i}}" value="{{ $fields['cat'] ?? '' }}"></td>
                </tr>

                @php
                    $i++;
                @endphp
            @endforeach

        @else
            <tr>
                <td><input type="text" name="et_0" value=""></td>
                <td><input type="text" name="pproject_0" value=""></td>
                <td><input type="text" name="pexpl_0" value=""></td>
                <td><input type="text" name="maxp_0" value=""></td>
                <td><input type="text" name="cat_0" value=""></td>
            </tr>

            <tr>
                <td><input type="text" name="et_1" value=""></td>
                <td><input type="text" name="pproject_1" value=""></td>
                <td><input type="text" name="pexpl_1" value=""></td>
                <td><input type="text" name="maxp_1" value=""></td>
                <td><input type="text" name="cat_1" value=""></td>
            </tr>

            <tr>
                <td><input type="text" name="et_2" value=""></td>
                <td><input type="text" name="pproject_2" value=""></td>
                <td><input type="text" name="pexpl_2" value=""></td>
                <td><input type="text" name="maxp_2" value=""></td>
                <td><input type="text" name="cat_2" value=""></td>
            </tr>
        @endif

    </tbody>
</table>
