<tr>
    <td>{{ $record->name }}</td>
    <td>{{ $record->alias }}</td>
    <td>{{ $record->short }}</td>
    <td class="text-center">
        @if ($record->logo)
            <img src="{{Storage::url($record->logo)}}" class="avatar-sm" alt="">
        @else

        @endif
    </td>
    @include('common.crud_actions')
</tr>
