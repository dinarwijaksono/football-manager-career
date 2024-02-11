<table style="width: 850px">
    <tbody>

        @foreach ($clubs as $key)
            <tr class="p-1 bg-green-100 shadow flex mb-2">
                <td class="basis-6/12">{{ $key->name }}</td>
                <td class="basis-3/12 text-center">{{ $key->division_name }} </td>
                <th class="basis-3/12">
                    <button class="btn btn-primary rounded w-full">Pilih</button>
                </th>
            </tr>
        @endforeach


    </tbody>
</table>
