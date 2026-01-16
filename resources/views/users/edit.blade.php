@extends('layouts.auth')

@section('title', 'Editar usuario')

@section('content')
<div
    x-data="{
        showPassword: false,
        showPasswordConfirm: false,
        loading: false
    }"
    class="max-w-md mx-auto"
>
    <h2 class="text-2xl font-bold text-center text-gray-900 mb-6">
        Editar usuario
    </h2>

    {{-- Botón regresar --}}
    <div class="mb-4 text-left">
        <a href="{{ route('users.index') }}"
           class="inline-flex items-center gap-1 text-sky-700 hover:text-sky-900 text-sm font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Regresar
        </a>
    </div>

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
        action="{{ route('users.update', $user) }}"
        class="space-y-5"
        @submit="loading = true"
    >
        @csrf
        @method('PUT')

        {{-- Nombre --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 text-left">
                Nombre completo
            </label>
            <div class="relative mt-1">
                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $user->name) }}"
                    placeholder="Nombre del usuario"
                    required
                    class="block w-full h-10 pl-10 pr-3 text-sm text-gray-700
                           border border-gray-300 rounded shadow-sm
                           focus:outline-none focus:border-sky-400"
                >
            </div>
        </div>

        {{-- Email --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 text-left">
                Correo electrónico
            </label>
            <div class="relative mt-1">
                <input
                    type="email"
                    name="email"
                    value="{{ old('email', $user->email) }}"
                    placeholder="correo@ejemplo.com"
                    required
                    class="block w-full h-10 pl-10 pr-3 text-sm text-gray-700
                           border border-gray-300 rounded shadow-sm
                           focus:outline-none focus:border-sky-400"
                >
            </div>
        </div>

        {{-- Rol --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 text-left">
                Rol
            </label>
            <div class="relative mt-1">
                <select
                    name="role"
                    required
                    class="block w-full h-10 pl-3 pr-10 text-sm text-gray-700
                           border border-gray-300 rounded shadow-sm
                           focus:outline-none focus:border-sky-400"
                >
                    <option value="">Selecciona un rol</option>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrador</option>
                    <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>Usuario</option>
                </select>
            </div>
        </div>

        {{-- Contraseña --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 text-left">
                Nueva contraseña (opcional)
            </label>
            <div class="relative mt-1">
                <input
                    :type="showPassword ? 'text' : 'password'"
                    name="password"
                    placeholder="********"
                    class="block w-full h-10 pl-10 pr-10 text-sm text-gray-700
                           border border-gray-300 rounded shadow-sm
                           focus:outline-none focus:border-sky-400"
                >
                <button type="button" @click="showPassword = !showPassword"
                        class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                    <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg"
                         width="22" height="22" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"/>
                        <path d="M21 12c-2.4 4-5.4 6-9 6s-6.6-2-9-6c2.4-4 5.4-6 9-6s6.6 2 9 6"/>
                    </svg>
                    <svg x-show="showPassword" x-cloak xmlns="http://www.w3.org/2000/svg"
                         width="22" height="22" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 9c-2.4 2.667-5.4 4-9 4s-6.6-1.333-9-4"/>
                        <path d="M3 15l2.5-3.8"/>
                        <path d="M21 14.976l-2.492-3.776"/>
                        <path d="M9 17l.5-4"/>
                        <path d="M15 17l-.5-4"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Confirmar contraseña --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 text-left">
                Confirmar contraseña
            </label>
            <div class="relative mt-1">
                <input
                    :type="showPasswordConfirm ? 'text' : 'password'"
                    name="password_confirmation"
                    placeholder="********"
                    class="block w-full h-10 pl-10 pr-10 text-sm text-gray-700
                           border border-gray-300 rounded shadow-sm
                           focus:outline-none focus:border-sky-400"
                >
                <button type="button" @click="showPasswordConfirm = !showPasswordConfirm"
                        class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                    <svg x-show="!showPasswordConfirm" xmlns="http://www.w3.org/2000/svg"
                         width="22" height="22" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"/>
                        <path d="M21 12c-2.4 4-5.4 6-9 6s-6.6-2-9-6c2.4-4 5.4-6 9-6s6.6 2 9 6"/>
                    </svg>
                    <svg x-show="showPasswordConfirm" x-cloak xmlns="http://www.w3.org/2000/svg"
                         width="22" height="22" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 9c-2.4 2.667-5.4 4-9 4s-6.6-1.333-9-4"/>
                        <path d="M3 15l2.5-3.8"/>
                        <path d="M21 14.976l-2.492-3.776"/>
                        <path d="M9 17l.5-4"/>
                        <path d="M15 17l-.5-4"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Botón --}}
        <button
            type="submit"
            class="relative w-full rounded-md bg-sky-700 py-2 px-4 text-sm font-medium text-white
                   hover:bg-sky-800 focus:outline-none focus:ring-2 focus:ring-sky-500
                   focus:ring-offset-2 disabled:opacity-70"
            :disabled="loading"
        >
            <span x-show="!loading">Actualizar usuario</span>

            <span x-show="loading" class="flex items-center justify-center gap-2">
                <svg class="h-4 w-4 animate-spin" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" stroke="white" stroke-width="4" fill="none"/>
                </svg>
                Actualizando...
            </span>
        </button>
    </form>
</div>
@endsection
