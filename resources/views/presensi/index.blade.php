@extends('layouts.main')

@section('title', 'Presensi')

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
            <label for="buat_presensi"
                class="p-2 w-fit bg-green-500 rounded-lg font-semibold text-white text-sm lg:text-base hover:cursor-pointer">Buat
                Presensi</label>
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
        <div class="flex justify-between items-center mt-4">
            <p class="hidden lg:block font-bold text-gray-700 text-xl">Data Presensi</p>
            <div class="flex gap-2 items-center">
                <p>Semester</p>
                <select id="tahun-ajaran"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                    @foreach ($tahun_ajaran as $i => $tahun)
                        <option @selected($i == 0) value="{{ $tahun->kode_tahun_ajaran }}">
                            {{ $tahun->nama_tahun_ajaran }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mt-10">
            <div class="overflow-x-auto">
                <table class="table">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th>Waktu Perkuliahan</th>
                            <th>Mata Kuliah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="data_presensi">
                        <tr>
                            <td>Loading...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        const tahun_ajaran_toggle = document.getElementById('tahun-ajaran');
        $(document).ready(function() {
            $('#tahun-ajaran').select2().on('change', function(e) {
                getData(e.target.value)
            });;
        });

        function getData(tahun_ajaran) {
            document.getElementById('data_presensi').innerHTML = `<tr>
                            <td>Loading...</td>
                        </tr>`;
            fetch(`/api/presensi/${tahun_ajaran}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json'
                    }
                }).then(response => response.json())
                .then(data => {
                    if (data.data.length > 0) {
                        let html = ''
                        data.data.forEach((d) => {
                            if ({{ time() }} < parseInt(d.time_to_edit)) {
                                html += `<tr>
                                            <td>${d.waktu_perkuliahan}</td>
                                            <td>${d.mata_kuliah}</td>
                                            <td class="flex gap-1">
                                                <div class="bg-blue-500 p-2 rounded-lg w-fit text-white">
                                                    <a href="/presensi/${d.kode_pertemuan}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                            stroke="currentColor" class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        </svg>
                                                    </a>
                                                </div>
                                                <div class="bg-red-500 p-2 rounded-lg w-fit text-white">
                                                    <button onclick="delete_data('${d.kode_pertemuan}')" href="/presensi/${d.kode_pertemuan}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                                            <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>`

                            } else {
                                html += `<tr>
                                            <td>${d.waktu_perkuliahan}</td>
                                            <td>${d.mata_kuliah}</td>
                                            <td>
                                                <div class="bg-blue-500 p-2 rounded-lg w-fit text-white">
                                                    <a href="/presensi/${d.kode_pertemuan}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                            stroke="currentColor" class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        </svg>
                                                    </a>
                                                </div>
                                                </td>
                                        </tr>`
                            }
                        })
                        document.getElementById('data_presensi').innerHTML = html
                    } else {
                        document.getElementById('data_presensi').innerHTML = `<tr>
                            <td>Belum ada data</td>
                        </tr>`;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('data_presensi').innerHTML = `<tr>
                            <td>Error</td>
                        </tr>`;
                });
        }
        getData(tahun_ajaran_toggle.value)


        function delete_data(kode_pertemuan) {
            Swal.fire({
                title: 'Yakin mau menghapus data?',
                text: "Data tidak akan bisa dikembalikan",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/presensi/${kode_pertemuan}/hapus`
                }
            })
        }
    </script>
@endsection

@section('bottom')
    <input type="checkbox" id="buat_presensi" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Tambah Presensi</h3>
            <form id="form_presensi" action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-6 mt-6">
                    <label for="mata_kuliah" class="block mb-2 text-sm font-medium text-gray-900">Mata Kuliah</label>
                    <input type="text" id="mata_kuliah" name="mata_kuliah" value="{{ old('mata_kuliah') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5">
                </div>
                <div class="mb-6">
                    <label for="aktivitas" class="block mb-2 text-sm font-medium text-gray-900 ">Aktivitas</label>
                    <textarea id="aktivitas" rows="4" name="aktivitas"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 "
                        placeholder="Aktivitas">{{ old('aktivitas') }}</textarea>
                </div>
                <div class="mb-6 mt-6">
                    <label for="jumlah_mahasiswa" class="block mb-2 text-sm font-medium text-gray-900">Jumlah
                        Mahasiswa</label>
                    <input type="number" id="jumlah_mahasiswa" name="jumlah_mahasiswa"
                        value="{{ old('jumlah_mahasiswa') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5">
                </div>
                <div class="mb-6 mt-6">
                    <label for="mahasiswa_tidak_hadir" class="block mb-2 text-sm font-medium text-gray-900">Mahasiswa
                        tidak
                        hadir</label>
                    <input type="number" id="mahasiswa_tidak_hadir" name="mahasiswa_tidak_hadir"
                        value="{{ old('mahasiswa_tidak_hadir') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5">
                </div>
                <div class="mb-6 mt-6">
                    <label for="mahasiswa_tidak_hadir" class="block mb-2 text-sm font-medium text-gray-900">Detail Mahasiswa
                        tidak
                        hadir</label>
                    <textarea id="detail_mahasiswa_tidak_hadir" rows="4" name="detail_mahasiswa_tidak_hadir"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 "
                        placeholder="Ahmad Junaidi, Ilham Saputra, Syauqi Ramadhan">{{ old('detail_mahasiswa_tidak_hadir') }}</textarea>
                </div>
                <div class="mb-6">
                    <label for="tanggal" class="block mb-2 text-sm font-medium text-gray-900">Tanggal
                        Perkuliahan</label>
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </div>
                        <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                            placeholder="Select date">
                    </div>
                </div>
                <div class="mb-6 mt-6">
                    <label for="dari_jam" class="block mb-2 text-sm font-medium text-gray-900">Jam Perkuliahan</label>
                    <div class="grid grid-cols-3 gap-2 items-center">
                        <input type="time" id="dari_jam" name="dari_jam" value="{{ old('dari_jam') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5">
                        <p class="text-center">Sampai</p>
                        <input type="time" id="sampai_jam" name="sampai_jam" value="{{ old('sampai_jam') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5">
                    </div>
                </div>
                <div class="mb-6 mt-6">
                    <label for="foto_perkuliahan" class="block mb-2 text-sm font-medium text-gray-900">Foto
                        Perkuliahan</label>
                    <input id="foto_perkuliahan" name="foto_perkuliahan" type="file"
                        class="file-input w-full max-w-xs" />
                </div>
                <div class="mb-6">
                    <button id="submit_button"
                        class="bg-green-500 rounded-lg font-semibold text-white text-sm lg:text-base p-2">Upload</button>
                </div>
            </form>
        </div>
        <label class="modal-backdrop" for="buat_presensi">Close</label>
    </div>
    <script>
        const form = document.getElementById('form_presensi');
        const submit_button = document.getElementById('submit_button');

        submit_button.addEventListener('click', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Yakin mau mensubmit data?',
                text: "Data maksimal bisa diedit dan dihapus setelah 1 jam melakukan submit",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Submit sekarang'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit()
                }
            })
        })
    </script>
@endsection
