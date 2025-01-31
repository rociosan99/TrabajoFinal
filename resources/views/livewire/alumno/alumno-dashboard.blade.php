<div class="container mx-auto p-6 bg-gradient-to-r from-indigo-500 bg-sky-500 to-bg-sky-950 rounded-lg shadow-lg">
    <!-- Título de bienvenida -->
    <div class="text-center mb-6">
        <h1 class="text-4xl font-extrabold text-white">Bienvenido, {{ Auth::user()->name }}!</h1>
        <p class="text-lg text-gray-200 mt-2">Aquí podrás ver el curso al que estás inscrito.</p>
    </div>

    <!-- Mostrar solo una card de curso -->
    @if($cursos->isNotEmpty())
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3">
            <!-- Mostrar solo el primer curso -->
            <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition duration-300">
                <h3 class="text-2xl font-semibold text-gray-800">{{ $cursos->first()->nombre }}</h3>
                <p class="text-gray-600 mt-2">Profesor: {{ $cursos->first()->usuario->name }}</p>
                <!-- Otros detalles del curso -->
            </div>

            
        </div>
    @else
        <p class="text-white text-center">No estás inscrito en ningún curso actualmente.</p>
    @endif
</div>
