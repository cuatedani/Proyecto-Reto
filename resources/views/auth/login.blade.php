@extends('layouts.guest')

@section('title', 'Iniciar sesión')

@section('content')
<div
    x-data="{
        showPassword: false,
        loading: false
    }"
    class="max-w-md mx-auto"
>
    <h2 class="text-2xl font-bold text-center text-gray-900 mb-6">
        Iniciar sesión
    </h2>

    {{-- Errores --}}
    @if ($errors->any())
        <div class="mb-4 rounded-md bg-red-50 p-4 text-sm text-red-700">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        method="POST"
        action="{{ route('login.action') }}"
        class="space-y-5"
        @submit="loading = true"
    >
        @csrf

        <div>
            {{-- Input Correo --}}
            <label class="block text-sm font-medium text-gray-700 text-left">
                Correo electrónico
            </label>
            <div class="relative mt-1">
                <input type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="youremail@mail.com"
                    required
                    class="block w-full h-10 pl-10 pr-3 mt-1 text-sm text-gray-700 border border-gray-300 focus:outline-none rounded shadow-sm focus:border-sky-400"
                >
                <span class="absolute inset-y-0 left-0 flex items-center justify-center ml-2">
                    <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="#000000"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    >
                    <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
                    <path d="M3 7l9 6l9 -6" />
                    </svg>
                </span>
            </div>
        </div>

        {{-- Input Contraseña --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 text-left">
                Contraseña
            </label>
            <div class="relative mt-1">
                <input
                    :type="showPassword ? 'text' : 'password'"
                    name="password"
                    placeholder="*********"
                    required
                    class="block w-full h-10 pl-10 pr-3 mt-1 text-sm text-gray-700 border border-gray-300 focus:outline-none rounded shadow-sm focus:border-sky-400"
                >

                <span class="absolute inset-y-0 left-0 flex items-center justify-center ml-2">
                    <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="#000000"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    >
                    <path d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z" />
                    <path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0" />
                    <path d="M8 11v-4a4 4 0 1 1 8 0v4" />
                    </svg>
                </span>

                <button
                    type="button"
                    @click="showPassword = !showPassword"
                    class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 hover:text-gray-700"
                >
                    <svg
                        x-show="!showPassword"
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                        <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                    </svg>

                    <svg
                        x-show="showPassword"
                        x-cloak
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path d="M21 9c-2.4 2.667 -5.4 4 -9 4c-3.6 0 -6.6 -1.333 -9 -4" />
                        <path d="M3 15l2.5 -3.8" />
                        <path d="M21 14.976l-2.492 -3.776" />
                        <path d="M9 17l.5 -4" />
                        <path d="M15 17l-.5 -4" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Recuerdame y Recuperación --}}
        <div class="flex items-center justify-between">
            <label class="flex items-center text-sm text-gray-700">
                <input
                    type="checkbox"
                    name="remember"
                    class="h-4 w-4 rounded border-gray-300 text-sky-600 focus:ring-sky-500"
                >
                <span class="ml-2">Recuérdame</span>
            </label>

            <a
                href="{{ route('recovery') }}"
                class="text-sm font-medium text-sky-700 hover:text-sky-900"
            >
                ¿Olvidaste tu contraseña?
            </a>
        </div>

        {{-- Boton login --}}
        <button
            type="submit"
            class="relative w-full rounded-md bg-sky-700 py-2 px-4 text-sm font-medium text-white
                   hover:bg-sky-800 focus:outline-none focus:ring-2 focus:ring-sky-500
                   focus:ring-offset-2 disabled:opacity-70"
            :disabled="loading"
        >
            <span x-show="!loading">Iniciar sesión</span>

            <span x-show="loading" class="flex items-center justify-center gap-2">
                <svg class="h-4 w-4 animate-spin" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" stroke="white" stroke-width="4" fill="none"/>
                </svg>
                Cargando...
            </span>
        </button>
    </form>

    {{-- Redirecciones --}}
    <p class="mt-6 text-center text-sm text-gray-600">
        ¿No tienes cuenta?
        <a href="{{ route('register') }}" class="font-medium text-sky-700 hover:text-sky-900">
            Regístrate
        </a>
    </p>
</div>
@endsection
