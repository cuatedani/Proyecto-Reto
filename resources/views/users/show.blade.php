@extends('layouts.auth')

@section('title', 'Ver usuario')

@section('content')
<div class="max-w-md mx-auto">
    <h2 class="text-2xl font-bold text-center text-gray-900 mb-6">
        Información del usuario
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

    {{-- Datos del usuario --}}
    <div class="bg-white shadow rounded-lg p-6 space-y-4">
        {{-- Nombre --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Nombre completo</label>
            <p class="mt-1 text-gray-900">{{ $user->name }}</p>
        </div>

        {{-- Correo --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Correo electrónico</label>
            <p class="mt-1 text-gray-900">{{ $user->email }}</p>
        </div>

        {{-- Rol --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Rol</label>
            <p class="mt-1 text-gray-900 capitalize">{{ $user->role }}</p>
        </div>
    </div>
</div>
@endsection
