<x-app-layout>
    <div x-data="{ open: false }">
        <!-- Botón del menú hamburguesa -->
        <div id="toggleSidebar" @click="open = ! open" style="position: fixed; top: 10px; left: 10px; z-index: 1000; cursor: pointer;">
            <div style="width: 30px; height: 3px; background-color: #fff; margin: 6px 0;"></div>
            <div style="width: 30px; height: 3px; background-color: #fff; margin: 6px 0;"></div>
            <div style="width: 30px; height: 3px; background-color: #fff; margin: 6px 0;"></div>
        </div>

        <!-- Sidebar -->
        <div id="sidebar" x-show="open" class="w-60 bg-slate-950 h-screen p-8 absolute start-0 end-0 z-10">
            <div class="w-full flex flex-col gap-4">
                <!-- Dashboard siempre visible -->
                <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-nav-link>

                <!-- Módulos visibles según los permisos -->
                @can('ver_modulo_usuarios')
                    <x-nav-link href="{{ route('users-users-index') }}" :active="request()->routeIs('users-*')">
                        Usuarios
                    </x-nav-link>
                @endcan

                @can('ver_modulo_cursos')
                    <x-nav-link href="{{ route('cursos-cursos-index') }}" :active="request()->routeIs('cursos-*')">
                        Cursos
                    </x-nav-link>
                @endcan

                @can('ver_modulo_examenes')
                    <x-nav-link href="{{ route('examenes-examenes-index') }}" :active="request()->routeIs('examenes-*')">
                        Examen
                    </x-nav-link>
                @endcan

                @can('ver_modulo_calificaciones')
                    <x-nav-link href="" :active="request()->routeIs('calificaciones-*')">
                        Calificaciones
                    </x-nav-link>
                @endcan

                <x-nav-link href="{{route('clases-clases-index')}}" :active="request()->routeIs('clases-*')">
                    Clases
                </x-nav-link>

                <x-nav-link href="" :active="request()->routeIs('')">
                    Asistencia
                </x-nav-link>

                <x-nav-link href="" :active="request()->routeIs('')">
                    Justificacion de Inasistencia
                </x-nav-link>

                <x-nav-link href="" :active="request()->routeIs('')">
                   Comunicados
                </x-nav-link>


            </div>
        </div>
    </div>

    <!-- Contenido del dashboard -->
    <header class="flex justify-start align-center gap-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-slate-950 w-full p-2 flex justify-start items-center gap-4">
            <span class="text-lg text-gray-100">
                @yield('view_title')
            </span>
            <nav>
                @yield('view_nav')
            </nav>
        </div>
    </header>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-2">
            @yield('view_content')
        </div>
    </div>
</x-app-layout>
