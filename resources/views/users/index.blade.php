@extends('layouts.auth')

@section('title', 'Usuarios')

@section('content')
    {{-- Contenido --}}
        <div x-data="{
            showDeleteModal: false,
            userToDelete: null,
            setUser(user) {
                this.userToDelete = user;
                this.showDeleteModal = true;
            },
            closeModal() {
                this.showDeleteModal = false;
                this.userToDelete = null;
            }
        }"
        class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
            <div class="text-left max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
                <h1 class="text-3xl font-bold text-gray-900">
                    Usuarios del sistema
                </h1>
                <p class="mt-2 text-gray-900">
                    Gestión y administración de usuarios registrados
                </p>
            </div>

            <div class="bg-gray-100 shadow rounded-lg overflow-hidden">
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

                {{-- Header tabla --}}
                <div class="px-6 py-4 border-b border-gray-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                    <h2 class="text-lg font-semibold text-gray-900">
                        Listado de usuarios
                    </h2>

                    <div class="flex gap-2">
                        <form method="GET" action="{{ route('users.index') }}" class="flex gap-2">
                            <input
                                type="text"
                                name="search"
                                placeholder="Buscar usuario..."
                                value="{{ request('search') }}"
                                class="pl-2 w-full sm:w-64 rounded-md bg-white border-gray-300 shadow-sm
                                    focus:border-sky-500 focus:ring-sky-500 text-sm"
                            >
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-sky-700 text-white text-sm font-medium rounded hover:bg-sky-800">
                                Buscar
                            </button>
                        </form>

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

                                    {{-- ACCIONES --}}
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

                                        <button
                                            @click="setUser({ id: {{ $user->id }}, name: '{{ $user->name }}', route: '{{ route('users.destroy', $user) }}' })"
                                            class="text-red-600 hover:text-red-900"
                                        >
                                            Eliminar
                                        </button>
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

            {{-- Modal eliminar --}}
            <div
                x-cloak
                x-show="showDeleteModal"
                x-transition
                class="fixed inset-0 z-40 min-h-full overflow-y-auto overflow-x-hidden flex items-center"
            >
                <!-- overlay -->
                <div @click="closeModal()" aria-hidden="true" class="fixed inset-0 w-full h-full bg-black/50 cursor-pointer"></div>

                <!-- Modal -->
                <div class="relative w-full cursor-pointer pointer-events-none my-auto p-4">
                    <div class="w-full py-2 bg-white cursor-default pointer-events-auto relative rounded-xl mx-auto max-w-sm">

                        <!-- Close button -->
                        <button @click="closeModal()" type="button" class="absolute top-2 right-2 rtl:right-auto rtl:left-2">
                            <svg title="Close" class="h-4 w-4 cursor-pointer text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close</span>
                        </button>

                        <!-- Modal content -->
                        <div class="space-y-2 p-2">
                            <div class="p-4 space-y-2 text-center">
                                <h2 class="text-xl font-bold tracking-tight" id="page-action.heading">
                                    Eliminar <span x-text="userToDelete ? userToDelete.name : ''"></span>
                                </h2>
                                <p class="text-gray-500">¿Estás seguro de que deseas eliminar este usuario? Esta acción no se puede deshacer.</p>
                            </div>
                        </div>

                        <!-- Modal actions -->
                        <div class="space-y-2">
                            <div aria-hidden="true" class="border-t px-2 border-gray-200"></div>
                            <div class="px-6 py-2">
                                <div class="grid gap-2 grid-cols-[repeat(auto-fit,minmax(0,1fr))]">
                                    <button @click="closeModal()" type="button"
                                            class="inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset min-h-9 px-4 text-sm text-gray-800 bg-white border-gray-300 hover:bg-gray-50">
                                        Cancelar
                                    </button>

                                    <form :action="userToDelete ? userToDelete.route : '#'" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors outline-none min-h-9 px-4 text-sm text-white shadow border-transparent bg-red-600 hover:bg-red-500 focus:bg-red-700">
                                            Confirmar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
@endsection
