<nav
    class="bg-linear-to-r from-sky-800 to-sky-900 shadow-lg"
    x-data="{ open: false, openProfile: false }"
>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            {{-- Logo y menú desktop --}}
            <div class="flex items-center">
                <div class="shrink-0">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span class="text-white font-semibold text-lg hidden sm:block">{{ config('app.name', 'Laravel') }}</span>
                    </a>
                </div>

                <div class="hidden md:ml-10 md:flex md:space-x-2">
                    {{-- Link Panel --}}
                    <a
                        href="{{ route('dashboard') }}"
                        class="{{ Route::is('dashboard') ? 'bg-sky-950 bg-opacity-50' : 'hover:bg-sky-800' }} rounded-md py-2 px-3 text-sm font-medium text-white transition-colors"
                    >
                        Panel
                    </a>

                    @if(auth()->user()->isAdmin())
                        <a
                            href="{{ route('users.index') }}"
                            class="{{ Route::is('users.*') ? 'bg-sky-950 bg-opacity-50' : 'hover:bg-sky-800' }} rounded-md py-2 px-3 text-sm font-medium text-white transition-colors"
                        >
                            Usuarios
                        </a>
                    @endif
                </div>
            </div>

            {{-- Perfil y menú móvil --}}
            <div class="flex items-center gap-4">
                {{-- Perfil desktop --}}
                <div class="hidden md:block relative" @click.away="openProfile = false">
                    <button
                        @click="openProfile = !openProfile"
                        class="flex items-center gap-3 rounded-lg py-2 px-3 text-sm font-medium text-white hover:bg-sky-800 transition-colors focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-sky-900"
                    >
                        <div class="text-right hidden lg:block">
                            <div class="text-sm font-medium text-white">{{ auth()->user()->name }}</div>
                            <div class="text-xs text-sky-200">{{ auth()->user()->email }}</div>
                        </div>
                        <img
                            class="h-10 w-10 rounded-full ring-2 ring-white ring-opacity-20"
                            src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=0ea5e9&color=fff&bold=true"
                            alt="{{ auth()->user()->name }}"
                        >
                        <svg
                            class="h-5 w-5 text-sky-200 transition-transform"
                            :class="{ 'rotate-180': openProfile }"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    {{-- Dropdown perfil --}}
                    <div
                        x-show="openProfile"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-lg bg-white shadow-xl ring-1 ring-black ring-opacity-5 focus:outline-none"
                        style="display: none;"
                    >
                        <div class="p-2">
                            <a
                                href="{{ route('profile.show') }}"
                                class="flex items-center gap-2 rounded-md py-2 px-3 text-sm text-gray-700 hover:bg-gray-100 transition-colors"
                                @click="openProfile = false"
                            >
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Mi Perfil
                            </a>
                            <div class="my-1 border-t border-gray-100"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button
                                    type="submit"
                                    class="flex w-full items-center gap-2 rounded-md py-2 px-3 text-sm text-red-700 hover:bg-red-50 transition-colors"
                                >
                                    <svg class="h-5 w-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Cerrar Sesión
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Botón menú móvil --}}
                <button
                    type="button"
                    class="md:hidden inline-flex items-center justify-center rounded-md p-2 text-sky-200 hover:bg-sky-800 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white transition-colors"
                    @click="open = !open"
                >
                    <span class="sr-only">Abrir menú</span>
                    <svg
                        class="h-6 w-6"
                        :class="{ 'hidden': open, 'block': !open }"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg
                        class="h-6 w-6"
                        :class="{ 'block': open, 'hidden': !open }"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Menú móvil --}}
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

        {{-- Perfil móvil --}}
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
