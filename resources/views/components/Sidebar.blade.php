<div x-cloak
    class="p-4 bg-white min-h-full lg:fixed absolute w-[300px] z-[10000] transition-all antialiased overflow-y-auto"
    :class="open ? 'left-0' : '-left-[300px]'">
    <div class="flex justify-between items-center">
        <div class="flex gap-2 items-center">
            <img src="{{ asset('assets/image/logo.png') }}" alt="logo" class="w-9">
            <div>
                <h1 class="text-xl font-semibold text-green-500">PORTAL DOSEN</h1>
                <p class="text-gray-600 font-semibold text-xs">SIAMAD</p>
            </div>
        </div>
        <button x-on:click="open = false" class="lg:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path fill-rule="evenodd"
                    d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z"
                    clip-rule="evenodd" />
            </svg>
        </button>
    </div>
    <hr class="mt-5">
    <p class="text-gray-400 font-semibold text-xs mt-5">MENU AKADEMIK</p>
    <div class="mt-3 flex flex-col gap-2 font-semibold text-sm text-gray-600">
        <a href="/profile"
            class="p-3 rounded flex gap-2 items-center @if (Request::is('profile*')) bg-green-500 text-white @else hover:text-green-500 @endif">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path fill-rule="evenodd"
                    d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
                    clip-rule="evenodd" />
            </svg>
            <p>
                Profile
            </p>
        </a>
    </div>
    <hr class="mt-5">
    <p class="text-gray-400 font-semibold text-xs mt-5">MENU PERKULIAHAN</p>
    <div class="mt-3 flex flex-col gap-2 font-semibold text-sm text-gray-600">

        <a href="/presensi"
            class="p-3 rounded flex gap-2 items-center @if (Request::is('presensi*')) bg-green-500 text-white @else hover:text-green-500 @endif">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path fill-rule="evenodd"
                    d="M5.625 1.5H9a3.75 3.75 0 013.75 3.75v1.875c0 1.036.84 1.875 1.875 1.875H16.5a3.75 3.75 0 013.75 3.75v7.875c0 1.035-.84 1.875-1.875 1.875H5.625a1.875 1.875 0 01-1.875-1.875V3.375c0-1.036.84-1.875 1.875-1.875zM9.75 17.25a.75.75 0 00-1.5 0V18a.75.75 0 001.5 0v-.75zm2.25-3a.75.75 0 01.75.75v3a.75.75 0 01-1.5 0v-3a.75.75 0 01.75-.75zm3.75-1.5a.75.75 0 00-1.5 0V18a.75.75 0 001.5 0v-5.25z"
                    clip-rule="evenodd" />
                <path
                    d="M14.25 5.25a5.23 5.23 0 00-1.279-3.434 9.768 9.768 0 016.963 6.963A5.23 5.23 0 0016.5 7.5h-1.875a.375.375 0 01-.375-.375V5.25z" />
            </svg>
            <p>
                Presensi
            </p>
        </a>
    </div>
    <hr class="my-5">
    <a href="https://siamad.stitastbr.ac.id" class="p-3 rounded flex gap-2 items-center bg-amber-500 text-white sticky">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
            <path fill-rule="evenodd"
                d="M9.53 2.47a.75.75 0 010 1.06L4.81 8.25H15a6.75 6.75 0 010 13.5h-3a.75.75 0 010-1.5h3a5.25 5.25 0 100-10.5H4.81l4.72 4.72a.75.75 0 11-1.06 1.06l-6-6a.75.75 0 010-1.06l6-6a.75.75 0 011.06 0z"
                clip-rule="evenodd" />
        </svg>

        <p>
            Kembali ke SIAMAD
        </p>
    </a>


</div>
