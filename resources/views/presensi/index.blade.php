@extends('layouts.main')

@section('title', 'Presensi')

@section('head-tag')
    <script src="https://unpkg.com/vue@3/dist/vue.global.prod.js"></script>
@endsection

@section('content')
    <div class="lg:p-5 p-2 min-h-screen" id="app">
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
            <label id="presensi_button" for="buat_presensi"
                class="p-2 w-fit bg-green-500 rounded-lg font-semibold text-white text-sm lg:text-base hover:cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                </svg>
            </label>
        </div>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="p-3 bg-red-400 rounded-lg my-2 flex gap-2 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p>
                        {{ $error }}
                    </p>
                </div>
            @endforeach
        @endif
        @if (session()->has('message'))
            <div role="alert" class="alert alert-success my-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('message') }}!</span>
            </div>
        @endif
        <div id="gps_warning" class="p-3 bg-amber-400 rounded-lg my-2 hidden gap-2 items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
            </svg>
            Anda belum berada di titik lokasi STIT Assunniyyah Tambarangan
        </div>
        <div id="gps_error" class="p-3 bg-red-400 rounded-lg my-2 hidden gap-2 items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
            </svg>
            Aplikasi belum mendapatkan akses lokasi atau GPS tidak aktif
        </div>
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
        <div class="pt-10">
            <div class="overflow-x-auto">
                <table class="table w-full lg:text-base text-xs">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Waktu Perkuliahan</th>
                            <th>Mata Kuliah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="data_presensi">
                        <tr v-for="(d, index) in data" :key="d.id">
                            <td class="w-[30px]">@{{ index + 1 }}</td>
                            <td class="w-[300px]">@{{ d.waktu_perkuliahan }}</td>
                            <td>@{{ d.mata_kuliah }}</td>
                            <td class="flex gap-2">
                                <div class="bg-blue-500 p-2 rounded-lg w-fit text-white">
                                    <a :href="`/presensi/${d.kode_pertemuan}`">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </a>
                                </div>
                                <div v-if="time < parseInt(d.time_to_edit)"
                                    class="bg-red-500 p-2 rounded-lg w-fit text-white">
                                    <button v-on:click="delete_data(d.kode_pertemuan)">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-6 h-6">
                                            <path fill-rule="evenodd"
                                                d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <p v-if="isLoading" class="text-center font-semibold mt-5 text-gray-500">Loading ...</p>
            <p v-if="!isLoading && data.length == 0 " class="text-center font-semibold mt-5 text-gray-500">Belum ada
                presensi
            </p>
        </div>
    </div>
    <script>
        const tahun_ajaran_toggle = document.getElementById('tahun-ajaran');

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        const {
            createApp,
            ref,
            onMounted
        } = Vue

        createApp({
            setup() {
                const data = ref([])
                const isLoading = ref(false)

                const time = {{ time() }}

                function getData(tahun_ajaran) {
                    isLoading.value = true
                    fetch(`/api/presensi/${tahun_ajaran}`, {
                            method: 'GET',
                            headers: {
                                'Accept': 'application/json'
                            }
                        }).then(response => response.json())
                        .then(res => {
                            data.value = res.data;

                            isLoading.value = false
                        })
                        .catch(error => {
                            Toast.fire({
                                icon: 'error',
                                title: 'Something Went Wrong'
                            })
                        });
                }

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

                onMounted(() => {
                    $(document).ready(function() {
                        $('#tahun-ajaran').select2().on('change', function(e) {
                            getData(e.target.value)
                        });;
                    })
                    getData(tahun_ajaran_toggle.value)
                })

                return {
                    data,
                    getData,
                    delete_data,
                    isLoading,
                    time
                }
            }
        }).mount('#app')


        if ("geolocation" in navigator) {
            const presensi_button = document.getElementById('presensi_button');
            const gps_warning = document.getElementById('gps_warning');
            const gps_error = document.getElementById('gps_error');
            presensi_button.style.display = 'none';
            gps_warning.style.display = 'none';
            navigator.geolocation.getCurrentPosition(function(position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;


                const distance = getDistanceFromLatLonInMeter(latitude, longitude, -3.0035154, 115.1255637);
                console.log(`Jarak antara dua titik: ${distance} meter`);
                if (distance < 500) {
                    presensi_button.style.display = 'block';
                } else {
                    gps_warning.style.display = 'flex';
                }

            }, function(error) {
                gps_error.style.display = 'flex';
            });
        } else {
            console.log("Geolocation tidak didukung oleh browser Anda.");
        }

        function getDistanceFromLatLonInMeter(lat1, lon1, lat2, lon2) {
            const R = 6371000;
            const dLat = deg2rad(lat2 - lat1);
            const dLon = deg2rad(lon2 - lon1);
            const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
                Math.sin(dLon / 2) * Math.sin(dLon / 2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            const distance = R * c;
            return Math.round(distance);
        }

        function deg2rad(deg) {
            return deg * (Math.PI / 180);
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
                    <select required id="mata_kuliah" name="mata_kuliah"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                        <option value="" disabled selected>Pilih Mata Kuliah</option>
                        @foreach ($mata_kuliah as $i => $m)
                            <option value="{{ $m->nama }}" @selected($m->nama == old('mata_kuliah'))>
                                {{ $m->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-6 mt-6">
                    <label for="jumlah_sks" class="block mb-2 text-sm font-medium text-gray-900">Jumlah
                        SKS</label>
                    <input required type="number" id="jumlah_sks" name="jumlah_sks" value="{{ old('jumlah_sks') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5">
                </div>
                <div class="mb-6">
                    <label for="aktivitas" class="block mb-2 text-sm font-medium text-gray-900 ">Aktivitas atau Materi
                        Perkuliahan</label>
                    <textarea required id="aktivitas" rows="4" name="aktivitas"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 "
                        placeholder="Aktivitas">{{ old('aktivitas') }}</textarea>
                </div>
                <div class="mb-6 mt-6">
                    <label for="jumlah_mahasiswa" class="block mb-2 text-sm font-medium text-gray-900">Jumlah
                        Mahasiswa</label>
                    <input required type="number" id="jumlah_mahasiswa" name="jumlah_mahasiswa"
                        value="{{ old('jumlah_mahasiswa') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5">
                </div>
                <div class="mb-6 mt-6">
                    <label for="mahasiswa_tidak_hadir" class="block mb-2 text-sm font-medium text-gray-900">Mahasiswa
                        tidak
                        hadir</label>
                    <input required type="number" id="mahasiswa_tidak_hadir" name="mahasiswa_tidak_hadir"
                        value="{{ old('mahasiswa_tidak_hadir') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5">
                </div>
                <div class="mb-6 mt-6">
                    <label for="mahasiswa_tidak_hadir" class="block mb-2 text-sm font-medium text-gray-900">Detail
                        Mahasiswa
                        tidak
                        hadir</label>
                    <textarea id="detail_mahasiswa_tidak_hadir" rows="4" name="detail_mahasiswa_tidak_hadir"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 "
                        placeholder="Ahmad Junaidi, Ilham Saputra, Syauqi Ramadhan">{{ old('detail_mahasiswa_tidak_hadir') }}</textarea>
                </div>
                @php
                    $max = new DateTime();
                    $max = $max->format('Y-m-d');

                    $min = new DateTime();
                    $min = $min->sub(new DateInterval('P7D'));
                    $min = $min->format('Y-m-d');
                @endphp
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
                        <input required type="date" id="tanggal" name="tanggal" value="{{ old('tanggal') }}"
                            max="{{ $max }}" min="{{ $max }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                            placeholder="Select date">
                    </div>
                </div>
                <div class="mb-6 mt-6">
                    <label for="dari_jam" class="block mb-2 text-sm font-medium text-gray-900">Jam Perkuliahan</label>
                    <div class="grid grid-cols-3 gap-2 items-center">
                        <input required type="time" id="dari_jam" name="dari_jam" value="{{ old('dari_jam') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5">
                        <p class="text-center">Sampai</p>
                        <input required type="time" id="sampai_jam" name="sampai_jam"
                            value="{{ old('sampai_jam') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5">
                    </div>
                </div>
                <div class="mb-6 mt-6">
                    <label for="foto_perkuliahan" class="block mb-2 text-sm font-medium text-gray-900">Foto
                        Perkuliahan</label>
                    <input required id="foto_perkuliahan" name="foto_perkuliahan" type="file"
                        class="file-input w-full max-w-xs" />
                </div>
                <div role="alert" class="alert alert-warning mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span>Data maksimal bisa diedit dan dihapus setelah 1 jam melakukan submit</span>
                </div>
                <div class="mb-6 flex justify-end gap-3">
                    <label for="buat_presensi"
                        class="bg-gray-200 text-gray-800 rounded-lg font-semibold text-sm lg:text-base p-2">BATAL</label>
                    <button id="submit_button"
                        class="bg-green-500 rounded-lg font-semibold text-white text-sm lg:text-base p-2">BUAT
                        PRESENSI</button>
                </div>
            </form>
        </div>
        <label class="modal-backdrop" for="buat_presensi">Close</label>
    </div>
    <script>
        // const form = document.getElementById('form_presensi');
        // const submit_button = document.getElementById('submit_button');
        $('#mata_kuliah').select2();
        // submit_button.addEventListener('click', function(e) {
        //     e.preventDefault();

        //     Swal.fire({
        //         title: 'Yakin mau mensubmit data?',
        //         text: "Data maksimal bisa diedit dan dihapus setelah 1 jam melakukan submit",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Submit sekarang'
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             form.submit()
        //         }
        //     })
        // })
    </script>
@endsection
