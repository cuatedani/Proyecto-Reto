@extends('layouts.guest')

@section('title', 'Recuperar acceso')

@section('content')
<div
    x-data="{
        loading: false,
        email: '{{ old('email') }}',
        emailError: '',
        validateForm() {
            // Limpiar errores
            this.emailError = ''

            // Validar email
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
            if (!this.email.trim()) {
                this.emailError = '* El correo es obligatorio.'
            } else if (this.email.length > 255) {
                this.emailError = '* El correo debe tener menos de 255 caracteres.'
            }else if (!emailPattern.test(this.email)) {
                this.emailError = '* El correo no tiene un formato válido.'
            }

            // Retornar si todo es válido
            return !this.emailError
        }
    }"
    class="max-w-md mx-auto"
>
    <h2 class="text-2xl font-bold text-center text-gray-900 mb-4">
        Recuperar acceso
    </h2>

    <p class="text-sm text-center text-gray-600 mb-6">
        Ingresa tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña.
    </p>

    {{-- Mensaje de éxito --}}
    @if (session('status'))
        <div class="mb-4 rounded-md bg-green-50 p-4 text-sm text-green-700">
            {{ session('status') }}
        </div>
    @endif

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
        action="{{ route('recovery.action') }}"
        class="space-y-5"
        @submit="loading = true"
    >
        @csrf

        {{-- Correo --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 text-left">
                Correo electrónico
            </label>

            <div class="relative mt-1">
                <input
                    type="email"
                    name="email"
                    x-model="email"
                    value="{{ old('email') }}"
                    placeholder="youremail@mail.com"
                    required
                    class="block w-full h-10 pl-10 pr-3 text-sm text-gray-700
                           border border-gray-300 rounded shadow-sm
                           focus:outline-none focus:border-sky-400"
                >

                <span class="absolute inset-y-0 left-0 flex items-center justify-center ml-2">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="22"
                        height="22"
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
            <p x-text="emailError" class="text-sm text-red-600"></p>
        </div>

        {{-- Botón --}}
        <button
            type="submit"
            @click.prevent="if(validateForm()){ $el.form.submit() }"
            class="relative w-full rounded-md bg-sky-700 py-2 px-4 text-sm font-medium text-white
                   hover:bg-sky-800 focus:outline-none focus:ring-2 focus:ring-sky-500
                   focus:ring-offset-2 disabled:opacity-70"
            :disabled="loading"
        >
            <span x-show="!loading">
                Enviar enlace de recuperación
            </span>

            <span x-show="loading" class="flex items-center justify-center gap-2">
                <svg class="mr-3 size-5 animate-spin ..." viewBox="0 0 24 24">
                    <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="4"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    >
                    <path d="M12 3a9 9 0 1 0 9 9" />
                    </svg>
                </svg>
                Enviando...
            </span>
        </button>
    </form>

    {{-- Redirección --}}
    <p class="mt-6 text-center text-sm text-gray-600">
        ¿Recordaste tu contraseña?
        <a href="{{ route('login') }}" class="font-medium text-sky-700 hover:text-sky-900">
            Inicia sesión
        </a>
    </p>
</div>
@endsection
