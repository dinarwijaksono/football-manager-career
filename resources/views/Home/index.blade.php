@extends('layout.home-layout')

@section('main')
    <main class="border w-[500px] absolute top-12 right-20 bg-slate-100 shadow-md">

        <section class="p-2">
            <h1 class="mb-4 font-bold text-center">Football Manager Career</h1>

            <ul>
                <a href="/Home/new-profile">
                    <li class="bg-green-600 p-2 rounded mb-2 text-white hover:underline hover:bg-green-500">Buat profile
                        baru
                    </li>
                </a>

                <a href="/Profile/load-profile">
                    <li class="bg-green-600 p-2 rounded mb-2 text-white hover:underline hover:bg-green-500">Muat profile
                    </li>
                </a>
            </ul>
        </section>

    </main>
@endsection
