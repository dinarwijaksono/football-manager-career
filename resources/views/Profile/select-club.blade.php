<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zara template</title>

    <link rel="stylesheet" href="/asset/tailwind/style.css">

</head>

<body class="bg-zinc-200">

    @livewire('Components.navbar')


    <div class="content">

        <!-- aside -->
        <div class="basis-2/12"></div>
        <!-- end asid -->


        <div class="wraper">
            <main>

                <section class="title">
                    <h1>Pilih Klub</h1>
                </section>

                <section>
                    <table style="width: 850px">
                        <tbody>


                            @for ($i = 0; $i < 5; $i++)
                                <tr class="p-1 bg-green-100 shadow flex mb-2">
                                    <td class="basis-6/12">nama club</td>
                                    <td class="basis-3/12 text-center">1</td>
                                    <th class="basis-3/12">
                                        <button class="btn btn-primary rounded w-full">Pilih</button>
                                    </th>
                                </tr>
                            @endfor

                        </tbody>
                    </table>
                </section>

            </main>

            <footer>
                <p>This template was created by <a href="https://github.com/dinarwijaksono"
                        target="_blank">@dinarwijaksono</a></p>
            </footer>
        </div> <!-- div wraper -->

    </div>

</body>

</html>
