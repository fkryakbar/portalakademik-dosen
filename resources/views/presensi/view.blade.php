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
            @if (time() < $presensi->time_to_edit)
                <div class="mt-3 rounded-lg border-[1px] border-gray-200 p-4">
                    <form action="" class="mt-5" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="mb-6">
                            <label for="mata_kuliah" class="block mb-2 text-sm font-medium text-gray-900">Mata
                                Kuliah</label>
                            <input type="text" id="mata_kuliah" name="mata_kuliah" value="{{ $presensi->mata_kuliah }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5">

                        </div>
                        <div class="mb-6">
                            <label for="nik" class="block mb-2 text-sm font-medium text-gray-900">Aktivitas</label>
                            <textarea id="aktivitas" rows="4" name="aktivitas"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">{{ $presensi->aktivitas }}</textarea>

                        </div>
                        <div class="mb-6">
                            <label for="jumlah_mahasiswa" class="block mb-2 text-sm font-medium text-gray-900">Jumlah
                                Mahasiswa</label>
                            <input type="number" id="jumlah_mahasiswa" name="jumlah_mahasiswa"
                                value="{{ $presensi->jumlah_mahasiswa }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5">

                        </div>
                        <div class="mb-6">
                            <label for="mahasiswa_tidak_hadir"
                                class="block mb-2 text-sm font-medium text-gray-900">Mahasiswa tidak
                                hadir</label>
                            <input type="text" id="mahasiswa_tidak_hadir" name="mahasiswa_tidak_hadir"
                                value="{{ $presensi->mahasiswa_tidak_hadir }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                                placeholder="mahasiswa_tidak_hadir">

                        </div>
                        <div class="mb-6">
                            <label for="nik" class="block mb-2 text-sm font-medium text-gray-900">Detail Mahasiswa
                                tidak
                                hadir</label>
                            <textarea id="detail_mahasiswa_tidak_hadir" rows="4" name="detail_mahasiswa_tidak_hadir"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">{{ $presensi->detail_mahasiswa_tidak_hadir }}</textarea>
                        </div>
                        @php
                            $max = new DateTime();
                            $max = $max->format('Y-m-d');
                            
                            $min = new DateTime();
                            $min = $min->sub(new DateInterval('P7D'));
                            $min = $min->format('Y-m-d');
                        @endphp
                        @php
                            $waktu_perkuliahan = $presensi->waktu_perkuliahan;
                            $waktu_array = explode(' ', $waktu_perkuliahan);
                            
                            $tanggal = $waktu_array[0];
                            $jam = $waktu_array[1];
                            
                            $jam_array = explode('-', $jam);
                            $dari_jam = $jam_array[0];
                            $sampai_jam = $jam_array[1];
                            
                        @endphp
                        <div class="mb-6">
                            <label for="tanggal" class="block mb-2 text-sm font-medium text-gray-900">Tanggal
                                Perkuliahan</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 " aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input type="date" id="tanggal" name="tanggal" value="{{ $tanggal }}"
                                    max="{{ $max }}" min="{{ $min }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                                    placeholder="Select date">
                            </div>
                        </div>
                        <div class="mb-6 mt-6">
                            <label for="dari_jam" class="block mb-2 text-sm font-medium text-gray-900">Jam
                                Perkuliahan</label>
                            <div class="grid grid-cols-3 gap-2 items-center">
                                <input type="time" id="dari_jam" name="dari_jam" value="{{ $dari_jam }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5">
                                <p class="text-center">Sampai</p>
                                <input type="time" id="sampai_jam" name="sampai_jam" value="{{ $sampai_jam }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5">
                            </div>
                        </div>
                        <div class="mb-6">
                            <label for="file_input" class="block mb-2 text-sm font-medium text-gray-900">Foto
                                Perkuliahan</label>
                            <img src="{{ asset('storage/' . $presensi->image_path) }}" alt="photo perkuliahan"
                                class="w-[200px] rounded">
                            <p class="mt-3 text-xs">Foto (jpg/jpeg, (max. 500 KB))</p>
                            <input class="file-input file-input-bordered w-full max-w-xs mt-3" id="file_input"
                                type="file" name="foto_perkuliahan">
                        </div>
                        <div class="mb-6">
                            <button type="submit"
                                class="bg-green-500 p-2 rounded-lg text-white hover:bg-green-800 font-bold transition-all">Simpan</button>
                        </div>
                    </form>
                </div>
            @else
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

            @endif
        </div>
    </div>

@endsection
