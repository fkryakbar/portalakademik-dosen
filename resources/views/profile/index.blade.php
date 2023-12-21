@extends('layouts.main')

@section('title', 'Profile')
@section('head-tag')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection
@section('content')
    <div class="p-5 min-h-screen">
        <div class="flex gap-2 items-center text-gray-500  mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10">
                <path fill-rule="evenodd"
                    d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
                    clip-rule="evenodd" />
            </svg>
            <h1 class="font-bold text-2xl">Profile</h1>
        </div>
        <form action="" enctype="multipart/form-data" method="POST">
            @csrf
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
            <div class="rounded-lg border-[1px] border-gray-200 lg:p-4 p-2">
                <h1 class="my-2 font-bold text-gray-600">AKUN</h1>
                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama Lengkap</label>
                    <input type="text" id="name" name="name" value="{{ $dosen->name }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                        placeholder="Nama">
                </div>
                <div class="mb-6">
                    <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                    <input type="text" id="username" value="{{ $dosen->username }}" disabled
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 cursor-not-allowed"
                        placeholder="Username">
                </div>
            </div>
            <div class="mt-3 rounded-lg border-[1px] border-gray-200 p-4">
                <h1 class="my-2 font-bold text-gray-600">BIODATA</h1>
                <div class="grid lg:grid-cols-2 grid-cols-1 gap-3">
                    <div>
                        <div class="mb-6">
                            <label for="file_input" class="block mb-2 text-sm font-medium text-gray-900">Foto Profil</label>
                            @if ($dosen->biodata->gambar)
                                <img src="{{ asset('storage/' . $dosen->biodata->gambar) }}" alt="photo profile"
                                    class="w-[200px] rounded">
                            @else
                                <img src="{{ asset('assets/image/generic_user.png') }}" alt="photo profile"
                                    class="w-[200px] rounded">
                            @endif
                            <p class="mt-3 text-xs">Foto (jpg/jpeg, (max. 100 KB) dengan ukuran 3:4)</p>
                            <input type="file" class="file-input w-full mt-3" id="file_input" type="file"
                                name="profile" />
                        </div>
                        <div class="mb-6">
                            <label for="nik" class="block mb-2 text-sm font-medium text-gray-900">NIK</label>
                            <input type="text" id="nik" name="nik" value="{{ $dosen->biodata->nik }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                                placeholder="NIK">

                        </div>
                        <div class="mb-6">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                            <input type="email" id="email" name="email" value="{{ $dosen->biodata->email }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                                placeholder="Email">
                        </div>
                        <div class="mb-6">
                            <label for="no_telp" class="block mb-2 text-sm font-medium text-gray-900">No Telelpon</label>
                            <input type="number" id="no_telp" name="no_telp" value="{{ $dosen->biodata->no_telp }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                                placeholder="No Telelpon">
                        </div>
                    </div>
                    <div>
                        <div class="mb-6">
                            <label for="jenis_kelamin" class="block mb-2 text-sm font-medium text-gray-900">Jenis
                                Kelamin</label>
                            <select id="jenis_kelamin" name="jenis_kelamin"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  ">
                                <option selected value="">Pilih Jenis Kelamin</option>
                                <option @selected($dosen->biodata->jenis_kelamin == 'laki-laki') value="laki-laki">Laki-laki</option>
                                <option @selected($dosen->biodata->jenis_kelamin == 'perempuan') value="perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-6">
                            <label for="tempat_lahir" class="block mb-2 text-sm font-medium text-gray-900">Tempat
                                Lahir</label>
                            <input type="text" id="tempat_lahir" name="tempat_lahir"
                                value="{{ $dosen->biodata->tempat_lahir }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                                placeholder="Tempat Lahir">
                        </div>
                        <div class="mb-6">
                            <label for="tanggal_lahir" class="block mb-2 text-sm font-medium text-gray-900">Tanggal
                                Lahir</label>
                            <div class="relative max-w-sm">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 " aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input type="date" value="{{ $dosen->biodata->tanggal_lahir }}" id="tanggal_lahir"
                                    name="tanggal_lahir"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                                    placeholder="Select date">
                            </div>
                        </div>
                        <div class="mb-6">
                            <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 ">Alamat</label>
                            <textarea id="alamat" rows="4" name="alamat"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 "
                                placeholder="Alamat">{{ $dosen->biodata->alamat }}</textarea>
                        </div>
                        <div class="mb-6">
                            <label for="pendidikan_terakhir"
                                class="block mb-2 text-sm font-medium text-gray-900">Pendidikan Terakhir</label>
                            <input type="text" id="pendidikan_terakhir" name="pendidikan_terakhir"
                                value="{{ $dosen->biodata->pendidikan_terakhir }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                                placeholder="Pendidikan Terakhir">
                        </div>
                        <div class="mb-6">
                            <label for="progam_studi" class="block mb-2 text-sm font-medium text-gray-900">Progam
                                Studi</label>
                            <select id="progam_studi" name="progam_studi"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  ">
                            </select>
                        </div>

                    </div>
                </div>
            </div>
            <button type="submit"
                class="text-white mt-5 bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Submit</button>
        </form>
    </div>
@endsection
