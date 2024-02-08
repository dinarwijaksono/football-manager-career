<table class=" w-full table-auto mb-10">
    <tbody>
        @foreach ($profiles as $profile)
            <tr class="bg-slate-200 flex mb-2">
                <td class="p-1 basis-4/12 pl-2">{{ $profile->name }}</td>
                <td class="p-1 basis-4/12 text-center">{{ date('H:i -- j F Y', $profile->created_at / 1000) }}</td>
                <td class="p-1 basis-2/12">
                    <button class="btn btn-danger rounded btn-sm w-full">Hapus</button>
                </td>
                <td class="p-1 basis-2/12">
                    <button class="btn btn-primary w-full btn-sm rounded">Mainkan</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
