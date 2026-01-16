<div class="flex h-16 items-center w-full">

    {{-- IZQUIERDA --}}
    <div class="flex items-center gap-3">

        {{-- BOTON MENU SM --}}
        <button
            type="button"
            class="md:hidden inline-flex items-center justify-center rounded-md p-2 text-sky-200 hover:bg-sky-800 hover:text-white"
            @click="open = !open"
        >
            <svg class="h-6 w-6" x-show="!open" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg class="h-6 w-6" x-show="open" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        {{-- LOGO --}}
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
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

        {{-- MENU LG --}}
        <div class="hidden md:flex md:space-x-2 ml-6">
            <a href="{{ route('dashboard') }}"
               class="{{ Route::is('dashboard') ? 'bg-sky-950' : 'hover:bg-sky-800' }} px-3 py-2 rounded-md text-white">
                Panel
            </a>

            @if(auth()->user()->isAdmin())
                <a href="{{ route('users.index') }}"
                   class="{{ Route::is('users.*') ? 'bg-sky-950' : 'hover:bg-sky-800' }} px-3 py-2 rounded-md text-white">
                    Usuarios
                </a>
            @endif
        </div>
    </div>

    {{-- DERECHA --}}
    <div class="ml-auto hidden md:flex items-center gap-3 relative"
         x-data="{ openProfile: false }">

        <span class="text-sm font-medium text-white">
            {{ auth()->user()->name }}
        </span>

        <button @click="openProfile = !openProfile">
            <img
                class="h-8 w-8 rounded-full"
                src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=0ea5e9&color=fff"
            >
        </button>

        <div
            x-show="openProfile"
            @click.away="openProfile = false"
            x-transition
            class="absolute right-0 top-12 w-44 bg-white rounded-md shadow-lg"
            style="display: none;"
        >
            <a href="{{ route('profile.show') }}"
               class="block px-4 py-2 text-sm hover:bg-gray-100 hover:rounded-md">
                Mi perfil
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100 hover:rounded-md">
                    Cerrar sesión
                </button>
            </form>
        </div>
    </div>

    {{-- MENU SM --}}
    <div x-show="open" x-transition class="md:hidden bg-sky-950" style="display: none;">
        <div class="space-y-1 px-4 pb-3 pt-2">
            <a
                href="{{ route('dashboard') }}"
                class="{{ Route::is('dashboard') ? 'bg-sky-900' : 'hover:bg-sky-900' }} block rounded-md py-2 px-3 text-base font-medium text-white transition-colors"
            >
                Panel
            </a>

            @if(auth()->user()->isAdmin())
                <a
                    href="{{ route('users.index') }}"
                    class="{{ Route::is('users.*') ? 'bg-sky-900' : 'hover:bg-sky-900' }} block rounded-md py-2 px-3 text-base font-medium text-white transition-colors"
                >
                    Usuarios
                </a>
            @endif
        </div>

        {{-- PERFIL SM --}}
        <div class="border-t border-sky-800 pb-3 pt-4">
            <div class="flex items-center px-4">
                <img
                    class="h-12 w-12 rounded-full ring-2 ring-white ring-opacity-20"
                    src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=0ea5e9&color=fff&bold=true"
                    alt="{{ auth()->user()->name }}"
                >
                <div class="ml-3">
                    <div class="text-base font-medium text-white">{{ auth()->user()->name }}</div>
                    <div class="text-sm font-medium text-sky-200">{{ auth()->user()->email }}</div>
                </div>
            </div>
            <div class="mt-3 space-y-1 px-4">
                <a
                    href="{{ route('profile.show') }}"
                    class="block rounded-md py-2 px-3 text-base font-medium text-sky-200 hover:bg-sky-900 hover:text-white transition-colors"
                >
                    Mi Perfil
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        type="submit"
                        class="w-full text-left block rounded-md py-2 px-3 text-base font-medium text-sky-200 hover:bg-sky-900 hover:text-white transition-colors"
                    >
                        Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
