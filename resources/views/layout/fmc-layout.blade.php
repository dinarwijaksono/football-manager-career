<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FMC</title>

    <link rel="stylesheet" href="./asset/tailwind/style.css">

</head>

<body class="bg-zinc-200">

    @livewire('components.navbar')

    <div class="content">

        <!-- aside -->
        @livewire('components.aside')
        <!-- end asid -->


        <div class="wraper">

            @yield('main')

            <footer>
                <p>This template was created by <a href="https://github.com/dinarwijaksono"
                        target="_blank">@dinarwijaksono</a></p>
            </footer>
        </div> <!-- div wraper -->

    </div>

</body>

</html>
