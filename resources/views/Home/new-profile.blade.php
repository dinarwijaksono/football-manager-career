@extends('layout.home-layout')

@section('main')
    <div class="flex flex-row justify-center">
        <main class="border bg-slate-100 shadow-md basis-10/12 mt-20">

            @livewire('profile.form-new-profile')

        </main>
    </div>
@endsection
