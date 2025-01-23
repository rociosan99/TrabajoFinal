<div>
    <!-- Botón para volver atrás -->
    <div class="mb-4">
        <a href="{{ route('cursos-cursos-index') }}" class="inline-flex items-center text-blue-500 hover:text-blue-700 font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-8 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Volver a cursos
        </a>
    </div>

    <!-- Contenido de la tabla -->
    <table class="w-full border-collapse border border-gray-500 bg-white">
        <thead>
            <tr class="bg-blue-500 text-white">
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Fecha</th>
                <th class="px-4 py-2">Hora Inicio</th>
                <th class="px-4 py-2">Hora Fin</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($clases as $clase)
                <tr>
                    <td class="border border-gray-300 text-center py-4 px-4">{{ $clase->id }}</td>
                    <td class="border border-gray-300 text-center py-4 px-4">{{ $clase->fecha_clase->format('d-m-Y') }}</td>
                    <td class="border border-gray-300 text-center py-4 px-4">{{ $clase->hora_inicio->format('H:i') }}</td>
                    <td class="border border-gray-300 text-center py-4 px-4">{{ $clase->hora_fin->format('H:i') }}</td>
                    <td class="border border-gray-300 text-center py-4 px-4">
                        <!-- Botón de Asistencias -->
                        <a href="{{ route('asistencias-asistencias-create',$clase->id)}}" 
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                             Asistencias
                         </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center border border-gray-300 py-4">No hay clases registradas</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Modal para mostrar los alumnos -->
    @if ($showModal)
        <div class="fixed inset-0 bg-gray-800 bg-opacity-75 flex justify-center items-center z-50">
            <div class="bg-white p-6 rounded shadow-lg w-3/4 max-w-xl">
                <h2 class="text-xl font-semibold mb-4">Alumnos de la clase ID: {{ $selectedClaseId }}</h2>
                <ul class="list-disc pl-6">
                    @forelse($alumnos as $alumno)
                        <li>{{ $alumno->name }}</li>
                    @empty
                        <li>No hay alumnos registrados en esta clase</li>
                    @endforelse
                </ul>
                <button 
                    wire:click="closeModal"
                    class="mt-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    Cerrar
                </button>
            </div>
        </div>
    @endif
</div>
