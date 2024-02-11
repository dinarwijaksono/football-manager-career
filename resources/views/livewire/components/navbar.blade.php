<nav>
    <h3 class="text-white inline-block"><b>{{ $profile->name }}</b> </h3>

    <ul class="inline-block absolute right-10">

        <li class="inline-block mr-2 text-white">
            12 November 2024
        </li>

        @if ($profile->managed_club !== null)
            <li class="inline-block mr-2">
                <button class="text-white py-1 px-5 text-[13px] bg-blue-500">Hari Berikutnya</button>
            </li>
        @endif

        <li class="inline-block">
            <button class=" text-white py-1 px-3 text-[13px] rounded bg-red-500" wire:click="doLogout">Logout</button>
        </li>
    </ul>
</nav>
