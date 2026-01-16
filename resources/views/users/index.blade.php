@extends('layouts.auth')

@section('title', 'Usuarios')

@section('content')
    {{-- Contenido --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
            <div class="text-left max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
                <h1 class="text-3xl font-bold text-gray-900">
                    Usuarios del sistema
                </h1>
                <p class="mt-2 text-gray-900">
                    Gestión y administración de usuarios registrados
                </p>
            </div>

            <div class="bg-gray-100 shadow rounded-lg overflow-hidden">

                {{-- Header tabla --}}
                <div class="px-6 py-4 border-b border-gray-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <h2 class="text-lg font-semibold text-gray-900">
                        Listado de usuarios
                    </h2>

                    <div class="flex gap-2">
                        <input
                            type="text"
                            placeholder="Buscar usuario..."
                            class="pl-2 w-full sm:w-64 rounded-md bg-white border-gray-300 shadow-sm
                                   focus:border-sky-500 focus:ring-sky-500 text-sm"
                        >

                        <a
                            href="{{ route('users.create') }}"
                            class=" gap-1 inline-flex items-center rounded-md bg-sky-700 px-4 py-2
                                   text-sm font-medium text-white hover:bg-sky-800
                                   focus:outline-none focus:ring-2 focus:ring-sky-500"
                        >
                            <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="#FFFFFF"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            >
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                            </svg>
                            Nuevo
                        </a>
                    </div>
                </div>

                {{-- Tabla --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Nombre
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Correo
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Rol
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">
                                    Acciones
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse ($users as $user)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                        {{ $user->name }}
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ $user->email }}
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        <span class="inline-flex rounded-full bg-sky-100 px-2 py-1 text-xs font-medium text-sky-800">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-right text-sm font-medium space-x-2">
                                        <a
                                            href="{{ route('users.show', $user) }}"
                                            class="text-sky-700 hover:text-sky-900"
                                        >
                                            Ver
                                        </a>

                                        <a
                                            href="{{ route('users.edit', $user) }}"
                                            class="text-indigo-600 hover:text-indigo-900"
                                        >
                                            Editar
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-6 text-center text-sm text-gray-500">
                                        No hay usuarios registrados
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Footer --}}
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $users->links() }}
                </div>

            </div>
        </div>
@endsection
