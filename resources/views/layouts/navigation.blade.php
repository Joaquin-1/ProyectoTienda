<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 h-28">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
        <div class="flex justify-between h-16">
            <div class="flex">
                <link rel="icon" href="{{ url('img/logo.png') }}">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('productos') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-black" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex text-xl">
                    @if (Auth::user()->rol == "admin")
                    <x-nav-link class="ml-20" :href="route('productos')" :active="request()->routeIs('productos')">
                        {{ __('Productos') }}
                    </x-nav-link>
                    @else
                    <x-nav-link class="ml-20" :href="route('productos')" :active="request()->routeIs('productos')">
                        {{ __('Products') }}
                    </x-nav-link>
                    <x-nav-link :href="route('carritos.index')" :active="request()->routeIs('carritos.index')">
                        {{ __('Cart') }} ({{ Auth::user()->carritos()->sum('cantidad') }})
                    </x-nav-link>
                    <x-nav-link :href="route('facturas.index')" :active="request()->routeIs('facturas.index')">
                        {{ __('My orders') }}
                    </x-nav-link>
                    <x-nav-link :href="route('contacto')" :active="request()->routeIs('contacto')">
                        {{ __('Contact') }}
                    </x-nav-link>

                    @endif
                    @if (Auth::user()->rol == "admin")

                    <x-nav-link :href="route('todosLosPedidos')" :active="request()->routeIs('todosLosPedidos')">
                        {{ __('Todos los pedidos') }}
                    </x-nav-link>

                    <x-nav-link :href="route('completados')" :active="request()->routeIs('completados')">
                        {{ __('Pedidos Completados') }}
                    </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-m font-medium text-[#9F8152] hover:text-[#4C3F2B] hover:border-orange-300 focus:outline-none focus:text-orange-500 focus:border-orange-300 transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('completadosUser')" :active="request()->routeIs('completadosUser')">
                                {{ __('Purchase history') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div class="sm:bg-white flex" :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1 bg-white h-auto text-black border">
            <x-responsive-nav-link :href="route('productos')" :active="request()->routeIs('productos')">
                {{ __('Products') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('carritos.index')" :active="request()->routeIs('carritos.index')">
                {{ __('Cart') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('facturas.index')" :active="request()->routeIs('facturas.index')">
                {{ __('My orders') }}
            </x-responsive-nav-link>
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>
        </div>

        <!-- Responsive Settings Options -->
        {{-- <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div> --}}
    </div>
</nav>
