@section('title', 'Penilaian | ' . $kelas->nama)

<div class="lg:p-5 p-2 min-h-screen">
    <div class="flex gap-2 items-center text-gray-500  mb-3">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            data-slot="icon" class="w-10 h-10">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
        </svg>
        <h1 class="font-bold text-2xl">Penilaian - {{ $kelas->nama }}</h1>
    </div>
    <div class="text-sm breadcrumbs">
        <ul>
            <li><a href="/penilaian">Penilaian</a></li>
            <li>Kelas</li>
        </ul>
    </div>
    <div class="grid grid-cols-1 gap-3">
        <div class="border-[1px] border-gray-200 rounded p-3">
            <h2 class="text-gray-700 font-semibold text-lg">Mata Kuliah </h2>
            <table class="min-w-[300px] text-sm">
                <tbody>
                    <tr>
                        <td>Kode</td>
                        <td>: {{ $kelas->mata_kuliah->kode }}</td>
                    </tr>
                    <tr>
                        <td>Mata Kuliah</td>
                        <td>: {{ $kelas->mata_kuliah->nama }}</td>
                    </tr>
                    <tr>
                        <td>Semester</td>
                        <td>: {{ $kelas->mata_kuliah->semester }}</td>
                    </tr>
                    <tr>
                        <td>SKS</td>
                        <td>: {{ $kelas->mata_kuliah->jumlah_sks }}</td>
                    </tr>
                    <tr>
                        <td>Status Penilaian</td>
                        <td class="flex gap-2">: @if ($kelas->is_validated == 1)
                                <p class="text-center text-xs bg-green-500 p-1 rounded text-white font-semibold">
                                    DIVALIDASI</p>
                            @else
                                <p class="text-center text-xs bg-amber-500 p-1 rounded text-white font-semibold">
                                    BELUM DIVALIDASI</p>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="border-[1px] border-gray-200 rounded p-3">
            <h2 class="text-gray-700 font-semibold text-lg">Dosen Pengampu </h2>
            @php
                $index = 1;
            @endphp
            @forelse ($kelas->dosen as $i => $p)
                @if ($p->role == 'dosen')
                    <p class="text-gray-600 text-sm ml-3">{{ $index }}. {{ $p->name }}</p>
                    @php
                        $index++;
                    @endphp
                @endif
            @empty
                <p class="text-xs text-gray-400">Belum ada dosen yang dipilih</p>
            @endforelse
        </div>
        <div class="border-[1px] border-gray-200 rounded p-3">
            <div class="flex flex-wrap justify-between items-center">
                <h2 class="text-gray-700 font-semibold text-lg">Mahasiswa</h2>
                <div class="flex gap-1 flex-wrap justify-end">
                    @if (count($mahasiswa) > 0)
                        <a class="btn bg-amber-500 hover:bg-amber-700 text-white" wire:loading.attr="disabled"
                            href="/penilaian/{{ $kelas->kode_kelas }}/cetak" target="_blank" wire:target="save">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                            </svg>
                            Cetak
                        </a>
                        @if ($kelas->is_validated != 1)
                            {{-- <button class="btn bg-blue-500 hover:bg-blue-700 text-white" wire:click="refresh_now"
                                wire:loading.attr="disabled" wire:target="save">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                                </svg>
                                Refresh
                            </button> --}}
                            <button class="btn bg-green-500 hover:bg-green-700 text-white" wire:click='save'
                                wire:loading.attr="disabled" wire:target="save">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 3.75H6.912a2.25 2.25 0 0 0-2.15 1.588L2.35 13.177a2.25 2.25 0 0 0-.1.661V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 0 0-2.15-1.588H15M2.25 13.5h3.86a2.25 2.25 0 0 1 2.012 1.244l.256.512a2.25 2.25 0 0 0 2.013 1.244h3.218a2.25 2.25 0 0 0 2.013-1.244l.256-.512a2.25 2.25 0 0 1 2.013-1.244h3.859M12 3v8.25m0 0-3-3m3 3 3-3" />
                                </svg>
                                Simpan
                            </button>
                        @endif
                    @endif
                </div>
            </div>
            @if (count($mahasiswa) > 0)
                <div class="overflow-x-auto mt-5">
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Mata Kuliah</th>
                                <th class="text-center">Tugas</th>
                                <th class="text-center">MT</th>
                                <th class="text-center">FT</th>
                                <th>Angka</th>
                                <th>Bobot</th>
                                <th>Huruf</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $index = 1;
                            @endphp
                            @foreach ($mahasiswa as $i => $m)
                                <livewire:penilaian.input-nilai :key="$m->id" :mahasiswa="$m" :kelas="$kelas"
                                    :index='$i' />
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-xs text-gray-400">Belum ada mahasiswa</p>
            @endif
        </div>
    </div>
    @if (session('success'))
        <div class="toast toast-top toast-end">
            <div class="alert alert-success">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" data-slot="icon" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif
</div>
