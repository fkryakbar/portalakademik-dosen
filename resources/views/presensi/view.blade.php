@extends('layouts.main')

@section('title', 'Detail Presensi')

@section('content')
    <div class="p-5 min-h-screen">
        <div class="flex justify-between items-center">
            <div class="flex gap-2 items-center text-gray-500  mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10">
                    <path fill-rule="evenodd"
                        d="M5.625 1.5H9a3.75 3.75 0 013.75 3.75v1.875c0 1.036.84 1.875 1.875 1.875H16.5a3.75 3.75 0 013.75 3.75v7.875c0 1.035-.84 1.875-1.875 1.875H5.625a1.875 1.875 0 01-1.875-1.875V3.375c0-1.036.84-1.875 1.875-1.875zM9.75 17.25a.75.75 0 00-1.5 0V18a.75.75 0 001.5 0v-.75zm2.25-3a.75.75 0 01.75.75v3a.75.75 0 01-1.5 0v-3a.75.75 0 01.75-.75zm3.75-1.5a.75.75 0 00-1.5 0V18a.75.75 0 001.5 0v-5.25z"
                        clip-rule="evenodd" />
                    <path
                        d="M14.25 5.25a5.23 5.23 0 00-1.279-3.434 9.768 9.768 0 016.963 6.963A5.23 5.23 0 0016.5 7.5h-1.875a.375.375 0 01-.375-.375V5.25z" />
                </svg>
                <h1 class="font-bold text-2xl">Presensi</h1>
            </div>
        </div>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="p-3 bg-red-400 rounded-lg my-2">
                    <li>{{ $error }}</li>
                </div>
            @endforeach

        @endif
        @if (session()->has('message'))
            <div class="p-3 bg-green-500 text-white rounded-lg my-2">
                <p>{{ session('message') }}</p>
            </div>
        @endif
        <div class="text-sm breadcrumbs">
            <ul>
                <li><a href="/presensi">Presensi</a></li>
                <li>Detail</li>
            </ul>
        </div>
        <div class="flex justify-between items-center mt-4">
            <p class="block font-bold text-gray-700 text-xl">Data Presensi</p>

        </div>

        <div>
            <div class="mt-3 rounded-lg border-[1px] border-gray-200 p-4">
                <div class="grid lg:grid-cols-2 grid-cols-1 gap-3">
                    <div>
                        <table class="table-auto border-collapse border-0">
                            <tbody>
                                <tr>
                                    <td class="p-2">Mata Kuliah</td>
                                    <td class="p-2">: {{ $presensi->mata_kuliah }}</td>
                                </tr>
                                <tr>
                                    <td class="p-2">Waktu Perkuliahan</td>
                                    <td class="p-2">: {{ $presensi->waktu_perkuliahan }}</td>
                                </tr>
                                <tr>
                                    <td class="p-2">Aktivitas</td>
                                    <td class="p-2">: {{ $presensi->aktivitas }}</td>
                                </tr>
                                <tr>
                                    <td class="p-2">Jumlah Mahasiswa</td>
                                    <td class="p-2">: {{ $presensi->jumlah_mahasiswa }}</td>
                                </tr>
                                <tr>
                                    <td class="p-2">Mahasiswa tidak hadir</td>
                                    <td class="p-2">: {{ $presensi->mahasiswa_tidak_hadir }}</td>
                                </tr>
                                @if ($presensi->detail_mahasiswa_tidak_hadir)
                                    <tr>
                                        <td class="p-2">Detail mahasiswa tidak hadir</td>
                                        <td class="p-2">: {{ $presensi->detail_mahasiswa_tidak_hadir }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <table class="table-auto border-collapse border-0">
                            <tbody>
                                <tr>
                                    <img src="{{ asset('storage/' . $presensi->image_path) }}" alt="Foto Perkuliahan"
                                        class="lg:w-[200px] w-full">
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
