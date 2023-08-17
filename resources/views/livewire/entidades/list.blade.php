<tr>
    <td>{{ $record->nombre }}</td>
    <td>{{ $record->abreviado }}</td>

    @include('common.table_list_predeterminado')

    @include('common.crud_actions')
</tr>

