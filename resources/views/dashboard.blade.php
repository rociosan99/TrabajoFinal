<x-app-layout>
    <x-slot name="header">
        <!-- Botón del menú hamburguesa -->
        <div id="toggleSidebar" style="position: fixed; top: 10px; left: 10px; z-index: 1000; cursor: pointer;">
            <!-- Icono de tres barritas (hamburger) -->
            <div style="width: 30px; height: 3px; background-color: #333; margin: 6px 0;"></div>
            <div style="width: 30px; height: 3px; background-color: #333; margin: 6px 0;"></div>
            <div style="width: 30px; height: 3px; background-color: #333; margin: 6px 0;"></div>
        </div>

        <!-- Barra lateral -->
        <div id="sidebar" class="closed" style="width: 0; height: 100vh; background-color: #333; color: white; position: fixed; top: 0; left: 0; overflow-x: hidden; transition: 0.5s; padding-top: 60px;">
            <a href="#" class="btn-sidebar" style="padding: 10px 15px; text-decoration: none; font-size: 18px; color: white; display: block;">Cursos</a>
            <a href="#" class="btn-sidebar" style="padding: 10px 15px; text-decoration: none; font-size: 18px; color: white; display: block;">Calificaciones</a>
            <a href="{{ route('logout') }}" style="padding: 10px 15px; text-decoration: none; font-size: 18px; color: white; display: block;" 
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Cerrar sesión
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @yield("view_content")
            </div>
        </div>
    </div>

    <script>
        const toggleSidebarButton = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');

        toggleSidebarButton.addEventListener('click', function() {
            if (sidebar.style.width === '0px' || sidebar.style.width === '') {
                sidebar.style.width = '250px';  // Ancho de la barra lateral cuando se despliega
            } else {
                sidebar.style.width = '0';  // Ocultar la barra lateral
            }
        });
    </script>
</x-app-layout>