<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div>
        <div x-data="{ open: false }" class="relative overflow-hidden bg-sky-700 pb-32">
            {{-- Navbar --}}
            <nav class="relative z-10 border-b border-teal-500 border-opacity-25">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="relative flex h-16 items-center justify-between">
                        <x-navbar />
                    </div>
                </div>
            </nav>

            {{-- Fondo decorativo --}}
            <div aria-hidden="true"
                class="inset-y-0 absolute inset-x-0 left-1/2 w-full -translate-x-1/2 transform overflow-hidden lg:inset-y-0"
                :class="{ 'bottom-0': open, 'inset-y-0': !open }">
                <div class="absolute inset-0 flex">
                    <div class="h-full w-1/2" style="background-color: #0a527b"></div>
                    <div class="h-full w-1/2" style="background-color: #065d8c"></div>
                </div>
                <div class="relative flex justify-center">
                    <svg class="shrink-0" width="1750" height="308" viewBox="0 0 1750 308" xmlns="http://www.w3.org/2000/svg">
                        <path d="M284.161 308H1465.84L875.001 182.413 284.161 308z" fill="#0369a1"></path>
                        <path d="M1465.84 308L16.816 0H1750v308h-284.16z" fill="#065d8c"></path>
                        <path d="M1733.19 0L284.161 308H0V0h1733.19z" fill="#0a527b"></path>
                        <path d="M875.001 182.413L1733.19 0H16.816l858.185 182.413z" fill="#0a4f76"></path>
                    </svg>
                </div>
            </div>

            {{-- Header --}}
            <header class="relative py-10">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            </header>
        </div>

        {{-- Main Content --}}
        <main class="relative -mt-32">
            <div class="mx-auto max-w-7xl px-4 pb-6 sm:px-6 lg:px-8 lg:pb-16">
                <div class="overflow-hidden rounded-lg bg-white shadow">
                    <div class="divide-y divide-gray-200 lg:grid lg:grid-cols-12 lg:divide-y-0 lg:divide-x">
                        <div class="py-6 px-4 sm:p-6 lg:pb-8 lg:col-span-12">
                            <div class="max-w-4xl mx-auto text-center py-12">
                                <h2 class="text-3xl font-bold text-gray-900 mb-4">
                                    Mi Reto Técnico
                                </h2>
                                <p class="text-lg text-gray-600 mb-8">
                                    Reto técnico para la postulación de<br>
                                    Logística Empresarial Megamente.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
