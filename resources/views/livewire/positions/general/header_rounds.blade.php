    <tr class="bg-dark text-white text-center text-sm">
        <th valign="middle">POS</th>
        <th valign="middle">PARTICIPANTE</th>
        @foreach ($rounds as $round)
            <td class="text-center">J-{{ $round->id }}</td>
        @endforeach
        <th rowspan="2" valign="middle">TOTAL</th>
    </tr>
