@extends('layout.home-layout')

@section('main')
    <div class="flex flex-row justify-center">
        <main class="border bg-slate-100 shadow-md basis-10/12 mt-20">

            <section class="p-2">
                <h1 class="mb-2 font-bold text-center">Football Manager Career</h1>

                <h2 class="mb-2">Buat Profile</h2>

                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" name="name" id="name" placeholder="Nama">
                    <p class="text-red-500">Lorem ipsum dolor sit amet consectetur adipisicing.</p>
                </div>

                <div class="form-group flex justify-end gap-2">
                    <div class="basis-2/12">
                        <a href="/" class="w-full bg-red-500 block text-center text-white py-1">Batal</a>
                    </div>

                    <div class="basis-2/12">
                        <button class="btn w-full btn-success">Buat profile</button>
                    </div>
                </div>

            </section>

        </main>
    </div>
@endsection
