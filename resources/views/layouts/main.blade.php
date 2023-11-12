<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @yield('head-tag')
    @vite('resources/css/app.css')
</head>

<body x-data="{ open: false }" class="bg-slate-100">
    <div class="preloader">
        <style>
            .loader {
                opacity: 1;
                transition: all 1000ms;
                top: 0%
            }

            .hide {
                opacity: 0;

            }

            .top {
                display: none;
            }
        </style>
        <div class="loader fixed bg-white w-full h-screen z-[500]" id="loader">
            <div class="flex justify-center items-center h-screen">
                <div class="flex flex-col items-center mx-4">
                    <img src="{{ asset('assets/image/logo.png') }}" alt="logo" class="lg:w-[200px] w-[150px]">
                    <h1 id="animated-word" class="mt-3 lg:text-3xl text-xl font-semibold uppercase text-center"></h1>
                </div>
            </div>
        </div>
        <script>
            const word = "Portal Akademik Dosen";
            const animatedWordElement = document.getElementById("animated-word");

            function animateText(index) {
                if (index < word.length) {
                    animatedWordElement.textContent += word[index];
                    index++;
                    setTimeout(() => animateText(index), 40)
                }
            }

            window.onload = function() {
                animateText(0)
                setTimeout(() => {
                    document.getElementById('loader').classList.add('hide');
                    setTimeout(() => {
                        document.getElementById('loader').classList.add('top');
                    }, 1200)
                }, 1200);
            }
        </script>
    </div>
    <div class="flex lg:gap-3 w-full relative ">
        <div class="lg:basis-[13%] relative flex-grow">
            <x-Sidebar />
        </div>
        <div class="lg:basis-[87%] w-full flex-grow">
            <div x-show="open" x-transition:enter="transition ease-in-out duration-150"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
            </div>
            <div class="p-2 flex flex-col">
                <x-Header />
                <div class="p-2 bg-white rounded shadow mt-3 flex-grow">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @yield('bottom')
</body>

</html>
