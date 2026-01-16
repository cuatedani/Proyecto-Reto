@extends('layouts.auth')

@section('title', 'Panel')

@section('content')
<div class="max-w-4xl mx-auto text-center py-12">
    <h2 class="text-3xl font-bold text-gray-900 mb-2">
        ¡Bienvenido, {{ auth()->user()->name }}!
    </h2>

    <p class="text-gray-600 mb-6">
        Nos alegra verte de nuevo en el sistema.
    </p>

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
@endsection
