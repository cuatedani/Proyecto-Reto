@extends('layouts.auth')

@section('title', 'Panel')

@section('content')
<div class="max-w-4xl mx-auto py-12 space-y-8">

    {{-- Bienvenida --}}
    <div class="text-center">
        <h2 class="text-3xl font-bold text-gray-900 mb-2">
            ¡Bienvenido, {{ auth()->user()->name }}!
        </h2>
        <p class="text-gray-600 mb-6">
            Nos alegra verte de nuevo en el sistema. <br>
            Tu función es <span class="font-medium">{{ auth()->user()->role }}</span>
        </p>
    </div>

    {{-- Información del reto --}}
    <div class="text-center">
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">
            Mi Reto Técnico
        </h3>
        <p class="text-lg text-gray-600">
            Reto técnico para la postulación de<br>
            <span class="font-medium text-gray-700">
                Logística Empresarial Megamente
            </span>.
        </p>
    </div>

    {{-- Sección de consumo de API --}}
    <div
        x-data="{
            query: '',
            loading: false,
            error: '',
            result: null,
            async fetchData() {
                this.error = '';
                this.result = null;

                // Validación básica
                if (!this.query.trim()) {
                    this.error = 'Debes ingresar un pokemon para la búsqueda.';
                    return;
                }

                this.loading = true;
                this.query = this.query.toLowerCase();
                try {
                    const response = await fetch(`https://pokeapi.co/api/v2/pokemon/${encodeURIComponent(this.query)}`);
                    if (!response.ok) {
                        throw new Error(`Error en la petición: ${response.status}`);
                    }
                    const data = await response.json();
                    this.result = data;
                } catch (err) {
                    this.error = err.message;
                } finally {
                    this.loading = false;
                }
            }
        }"
        class="bg-white shadow rounded-lg p-6 max-w-xl mx-auto"
    >
        <h4 class="text-xl font-semibold text-gray-800 mb-4">Cual es tu pokemon favorito?</h4>

        {{-- Input de búsqueda --}}
        <div class="flex gap-2 mb-4">
            <input
                type="text"
                placeholder="Ingresa tu pokemon"
                x-model="query"
                class="flex-1 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-sky-500"
            >
            <button
                @click="fetchData"
                :disabled="loading"
                class="bg-sky-700 text-white px-4 py-2 rounded hover:bg-sky-800 disabled:opacity-70"
            >
                <span x-show="!loading">Buscar</span>
                <span x-show="loading">Buscando...</span>
            </button>
        </div>

        <img
            x-show="result"
            :src="result.sprites.front_default"
            alt="Imagen del Pokémon"
            class="mx-auto my-4"
        />

        {{-- Mensaje de error --}}
        <template x-if="error">
            <div class="mb-4 text-sm text-red-600" x-text="error"></div>
        </template>

        {{-- Mostrar resultados --}}
        <template x-if="result">
            <div class="mt-4 bg-gray-50 p-4 rounded max-h-100 overflow-y-scroll">
                <pre class="text-left text-sm text-gray-800 overflow-x-auto" x-text="JSON.stringify(result, null, 2)"></pre>
            </div>
        </template>

        {{-- Mensaje si no hay resultados --}}
        <template x-if="!result && !error && !loading">
            <div class="mt-4 text-sm text-gray-500">
                Ingresa el nombre de un pokemon y presiona buscar para ver sus datos.
            </div>
        </template>
    </div>
</div>
@endsection
