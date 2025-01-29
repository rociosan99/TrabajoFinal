<!-- resources/views/livewire/admin/admin-dashboard.blade.php -->
<div class="container mx-auto p-6 bg-gradient-to-r from-blue-500 via-teal-500 to-green-500 rounded-lg shadow-lg">
    <!-- Título de bienvenida -->
    <div class="text-center mb-6">
        <h1 class="text-4xl font-extrabold text-white">Bienvenida, {{ Auth::user()->name }}!</h1>
        <p class="text-lg text-gray-200 mt-2">Aquí podrás ver un resumen de la administración del instituto.</p>
    </div>

    <!-- Resumen de Estadísticas -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3">

        <!-- Total Cursos -->
        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition duration-300">
            <h3 class="text-2xl font-semibold text-gray-800">Cursos</h3>
            <p class="text-4xl font-bold text-blue-600">{{ $totalCursos }}</p>
            <p class="text-gray-600">Total de cursos activos</p>
        </div>

        <!-- Total Profesores -->
        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition duration-300">
            <h3 class="text-2xl font-semibold text-gray-800">Profesores</h3>
            <p class="text-4xl font-bold text-blue-600">{{ $totalProfesores }}</p>
            <p class="text-gray-600">Total de profesores asignados</p>
        </div>
    </div>
</div>
