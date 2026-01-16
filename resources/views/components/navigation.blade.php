<div class="flex w-full items-center justify-between">
    {{-- Logo --}}
    <div class="flex items-center">
        <a href="{{ route('welcome') }}" class="flex items-center gap-2">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="40"
                height="40"
                viewBox="0 0 24 24"
                fill="none"
                stroke="#FFFFFF"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
            >
                <path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" />
            </svg>
            <span class="text-white font-semibold text-lg hidden sm:block">
                {{ config('app.name', 'Laravel') }}
            </span>
        </a>
    </div>

    {{-- Acciones --}}
    <div class="flex items-center gap-3">
        @auth
            <a
                href="{{ route('dashboard') }}"
                class="rounded-md bg-sky-800 px-4 py-2 text-sm font-medium text-white hover:bg-sky-900"
            >
                Panel
            </a>
        @else
            @if (!Route::is('login'))
                <a
                    href="{{ route('login') }}"
                    class="rounded-md bg-sky-800 px-4 py-2 text-sm font-medium text-white hover:bg-sky-900"
                >
                    Iniciar sesión
                </a>
            @endif

            @if (Route::has('register') && !Route::is('register'))
                <a
                    href="{{ route('register') }}"
                    class="rounded-md bg-white px-4 py-2 text-sm font-medium text-sky-800 hover:bg-gray-100"
                >
                    Registrarse
                </a>
            @endif
        @endauth
    </div>
</div>
