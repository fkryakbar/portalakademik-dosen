@section('title', 'Penilaian')

<div class="p-5 min-h-screen">
    <div class="flex gap-2 items-center text-gray-500  mb-3">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            data-slot="icon" class="w-10 h-10">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
        </svg>
        <h1 class="font-bold text-2xl">Penilaian</h1>
    </div>
    <div class="flex gap-2 justify-end items-center text-gray-500  mb-3">
        <input type="text" placeholder="Cari kelas" class="input input-bordered w-full max-w-xs"
            wire:model.live.debounce.250ms='search' />
    </div>
    @forelse ($kelas as $tahun => $t)
        <p class="text-gray-500 font-semibold mb-2">{{ $tahun }}</p>
        <div class="grid lg:grid-cols-4 gap-3 grid-cols-1 mb-5">
            @foreach ($t as $k)
                <div wire:key='{{ $k->id }}' class="border-[1px] border-gray-200 rounded p-3">
                    <div class="flex justify-center">
                        @if ($k->is_validated == 1)
                            <p class="text-center text-xs bg-green-500 p-1 rounded text-white font-semibold">
                                DIVALIDASI</p>
                        @endif
                    </div>
                    <h1 class="text-center text-lg font-semibold text-gray-700">{{ $k->nama }}</h1>
                    <div class="flex justify-center gap-2">
                        <p class="text-center text-xs bg-cyan-500 p-1 rounded text-white font-semibold">
                            {{ count($k->mahasiswa) }} Mahasiswa</p>
                    </div>
                    <p class="text-center text-sm text-gray-700">{{ $k->kode_mata_kuliah }}</p>
                    <p class="text-center text-sm text-gray-700">{{ $k->jadwal }}</p>
                    <div class="flex justify-center items-center gap-2 mt-2">
                        <a href="/penilaian/{{ $k->kode_kelas }}"
                            class="btn btn-sm bg-blue-500 hover:bg-blue-700 text-white"><svg
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @empty
        <div class="flex flex-col justify-center items-center mt-10 text-gray-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-20 h-20">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
            </svg>
            <p>Tidak ada kelas</p>
        </div>
    @endforelse

</div>
