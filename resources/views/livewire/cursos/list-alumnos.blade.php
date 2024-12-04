<div class="p-4">
    <h2 class="text-lg font-bold mb-4">Alumnos Matriculados en el Curso</h2>
    
    <!-- Botón Atrás -->
    <div class="mb-4">
        <a href="{{ route('cursos-cursos-index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">Atrás</a>
    </div>
    
    <!-- Tabla de alumnos matriculados -->
    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2 text-left">Nombre</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Apellido</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Correo Electrónico</th>
            </tr>
        </thead>
        <tbody>
            @forelse($alumnos as $alumno)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $alumno->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $alumno->apellido }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $alumno->email }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="border border-gray-300 px-4 py-2 text-center">No hay alumnos matriculados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    
</div>
