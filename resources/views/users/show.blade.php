@extends('layouts.auth')

@section('title', 'Ver usuario')

@section('content')
<div class="max-w-2xl mx-auto py-12">
    {{-- Encabezado --}}
    <div class="mb-6 text-center">
        <h2 class="text-3xl font-bold text-gray-900">Información del usuario</h2>
        <p class="text-gray-500 mt-1">Detalles del usuario registrado en el sistema.</p>
    </div>

    {{-- Botón regresar --}}
    <div class="mb-6 text-left">
        <a href="{{ route('users.index') }}"
           class="inline-flex items-center gap-1 text-sky-700 hover:text-sky-900 text-sm font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Regresar
        </a>
    </div>

    {{-- Información del usuario --}}
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="border-t border-gray-200">
            <dl>
                {{-- Nombre --}}
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Nombre completo</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $user->name }}</dd>
                </div>

                {{-- Correo --}}
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Correo electrónico</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $user->email }}</dd>
                </div>

                {{-- Rol --}}
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Rol</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 capitalize">{{ $user->role }}</dd>
                </div>

                {{-- Fecha de creación --}}
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Fecha de creación</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $user->created_at->format('d/m/Y H:i') }}</dd>
                </div>
            </dl>
        </div>
    </div>
</div>
@endsection
