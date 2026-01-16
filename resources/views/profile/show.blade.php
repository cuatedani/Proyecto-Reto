@extends('layouts.auth')

@section('title', 'Mi perfil')

@section('content')
<div
    x-data="{
        showPassword: false,
        showPasswordConfirm: false,
        loading: false,
        originalName: '{{ auth()->user()->name }}',
        originalEmail: '{{ auth()->user()->email }}',
        name: '{{ old('name', auth()->user()->name) }}',
        email: '{{ old('email', auth()->user()->email) }}',
        password: '',
        passwordConfirm: '',
        nameError: '',
        emailError: '',
        passwordError: '',
        passwordConfirmError: '',

        validateForm() {
            // Limpiar errores
            this.nameError = ''
            this.emailError = ''
            this.passwordError = ''
            this.passwordConfirmError = ''

            // Validar nombre
            if (!this.name.trim()) {
                this.nameError = '* El nombre es obligatorio.'
            } else if (this.name.length > 255) {
                this.nameError = '* El nombre debe tener menos de 255 caracteres.'
            }

            // Validar email
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
            if (!this.email.trim()) {
                this.emailError = '* El correo es obligatorio.'
            } else if (this.email.length > 255) {
                this.emailError = '* El correo debe tener menos de 255 caracteres.'
            } else if (!emailPattern.test(this.email)) {
                this.emailError = '* El correo no tiene un formato válido.'
            }

            // Validar contraseña
            if(this.password.trim()){
                if (this.password.length < 8) {
                    this.passwordError = '* La contraseña debe tener al menos 8 caracteres.'
                }

                if (this.password !== this.passwordConfirm) {
                    this.passwordConfirmError = '* Las contraseñas no coinciden.'
                }
            }

            // Retornar si todo es válido
            return !this.nameError && !this.emailError && !this.passwordError && !this.passwordConfirmError
        },

        hasChanged() {
            // Validar que haya cambios
            return this.name !== this.originalName ||
                   this.email !== this.originalEmail ||
                   this.password.trim() !== ''
        }
    }"
    class="max-w-md mx-auto"
>
    <h2 class="text-2xl font-bold text-center text-gray-900 mb-6">
        Mi perfil
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
        action="{{ route('profile.update') }}"
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
                    x-model="name"
                    value="{{ old('name', auth()->user()->name) }}"
                    required
                    class="block w-full h-10 pl-10 pr-3 text-sm text-gray-700
                           border border-gray-300 rounded shadow-sm
                           focus:outline-none focus:border-sky-400"
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
                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                    </svg>
                </span>
            </div>
            <p x-text="nameError" class="text-sm text-red-600"></p>
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
                    x-model="email"
                    value="{{ old('email', auth()->user()->email) }}"
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

        {{-- Nueva contraseña --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 text-left">
                Nueva contraseña (opcional)
            </label>
            <div class="relative mt-1">
                <input
                    :type="showPassword ? 'text' : 'password'"
                    name="password"
                    x-model="password"
                    placeholder="********"
                    class="block w-full h-10 pl-10 pr-10 text-sm text-gray-700
                           border border-gray-300 rounded shadow-sm
                           focus:outline-none focus:border-sky-400"
                >
                <span class="absolute inset-y-0 left-0 flex items-center ml-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                         fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M5 13h14v8H5z"/>
                        <path d="M9 13V9a3 3 0 1 1 6 0v4"/>
                    </svg>
                </span>

                <button
                    type="button"
                    @click="showPassword = !showPassword"
                    class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500"
                >
                    {{-- Ojo abierto --}}
                    <svg
                        x-show="!showPassword"
                        xmlns="http://www.w3.org/2000/svg"
                        width="22"
                        height="22"
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

                    {{-- Ojo cerrado --}}
                    <svg
                        x-show="showPassword"
                        x-cloak
                        xmlns="http://www.w3.org/2000/svg"
                        width="22"
                        height="22"
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
            <p x-text="passwordError" class="text-sm text-red-600"></p>
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
                    x-model="passwordConfirm"
                    placeholder="********"
                    class="block w-full h-10 pl-10 pr-10 text-sm text-gray-700
                           border border-gray-300 rounded shadow-sm
                           focus:outline-none focus:border-sky-400"
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
                    <path d="M11.5 21h-4.5a2 2 0 0 1 -2 -2v-6a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v.5" />
                    <path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0" />
                    <path d="M8 11v-4a4 4 0 1 1 8 0v4" />
                    <path d="M15 19l2 2l4 -4" />
                    </svg>
                </span>

                <button
                    type="button"
                    @click="showPasswordConfirm = !showPasswordConfirm"
                    class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500"
                >
                    <svg
                        x-show="!showPasswordConfirm"
                        xmlns="http://www.w3.org/2000/svg"
                        width="22"
                        height="22"
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
                        x-show="showPasswordConfirm"
                        x-cloak
                        xmlns="http://www.w3.org/2000/svg"
                        width="22"
                        height="22"
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
            <p x-text="passwordConfirmError" class="text-sm text-red-600"></p>
        </div>

        {{-- Botón --}}
        <button
            type="submit"
            @click.prevent="if(validateForm()){ $el.form.submit() }"
            class="relative w-full rounded-md bg-sky-700 py-2 px-4 text-sm font-medium text-white
                   hover:bg-sky-800 focus:outline-none focus:ring-2 focus:ring-sky-500
                   focus:ring-offset-2 disabled:opacity-70"
            :disabled="!hasChanges() || loading "
        >
            <span x-show="!loading">Actualizar Perfil</span>

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
                Guardando...
            </span>
        </button>
    </form>
</div>
@endsection
