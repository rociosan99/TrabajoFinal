<x-app-layout>
    <!-- cabecera del dashboard -->
    <!-- Botón del menú hamburguesa -->
    <!-- Icono de tres barritas (hamburger) -->
    <!-- cuerpo del dasboard -->
    <div class="p-4">
        <!-- Barra lateral -->
        <div x-data="{open: false}">
            <div id="toggleSidebar" @click="open = ! open" style="position: fixed; top: 10px; left: 10px; z-index: 1000; cursor: pointer;">
                <div style="width: 30px; height: 3px; background-color: #fff; margin: 6px 0;"></div>
                <div style="width: 30px; height: 3px; background-color: #fff; margin: 6px 0;"></div>
                <div style="width: 30px; height: 3px; background-color: #fff; margin: 6px 0;"></div>
            </div>
            <div id="sidebar" x-show="open"  class="w-60 bg-slate-950 h-screen p-8 absolute start-0 end-0 z-10" >
                <div class="w-full flex flex-col gap-4" >
                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('users-roles-index') }}" :active="request()->routeIs('users-*')">
                        Roles
                    </x-nav-link>  
                    <x-nav-link href="{{ route('users-users-index') }}" :active="request()->routeIs('users-*')">
                        Usuarios
                    </x-nav-link>  
                </div>
            </div>
        </div>
        
        <header class="flex justify-start align-center gap-4">
            @yield("view_title")
            <nav>
                @yield("view_nav")
            </nav>
        </header>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @yield("view_content")<!-- contenido dinamico-->
            </div>
        </div>
    </div>

     
</x-app-layout>