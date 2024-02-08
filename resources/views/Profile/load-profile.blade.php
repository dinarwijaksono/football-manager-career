@extends('layout.home-layout')

@section('main')
    <div class="flex flex-row justify-center">
        <main class="border bg-slate-100 shadow-md basis-10/12 mt-20">

            <section class="p-2 mb-2">
                <h1 class="mb-2 font-bold text-center">Football Manager Career</h1>

                @livewire('profile.table-the-list-profile')

                <div class="flex justify-end">
                    <a href="/" class="block bg-red-500 text-white px-4 py-1 rounded">Kembali</a>
                </div>

            </section>

        </main>
    </div>
@endsection
