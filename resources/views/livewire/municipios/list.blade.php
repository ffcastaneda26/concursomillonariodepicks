<tr>
    <td class="border w-80">{{ $record->entidad->nombre }}</td>
    <td class="border w-10">{{ $record->nombre }}</td>
    @include('common.table_list_predeterminado')

    @include('common.crud_actions')
</tr>
