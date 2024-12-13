<div> 
    <!-- Botón para volver atrás -->
    <div class="mb-4">
        <a href="{{ route('cursos-cursos-index') }}" class="inline-flex items-center text-blue-500 hover:text-blue-700 font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Volver a cursos
        </a>
    </div>

    <!-- Contenido de la tabla -->
    <div class="p-4">
        <h3 class="text-lg font-medium text-gray-900">Cantidad de clases: {{ count($clases) }}</h3>
    </div>

    <table class="w-full border-collapse border border-gray-300 bg-white">
        <thead>
            <tr class="bg-blue-500 text-white">
                <th class="border border-gray-300 p-2 text-md">ID</th>
                <th class="border border-gray-300 p-2 text-md">Fecha</th>
                <th class="border border-gray-300 p-2 text-md">Hora Inicio</th>
                <th class="border border-gray-300 p-2 text-md">Hora Fin</th>
            </tr>
        </thead>
        
        <tbody>
            @forelse($clases as $clase)
                <tr>
                    <td class="border border-gray-300 p-2">{{ $clase->id }}</td>
                    <td class="border border-gray-300 p-2">{{ $clase->fecha_clase->format('d-m-Y') }}</td> <!-- Fecha -->
                    <td class="border border-gray-300 p-2">{{ $clase->hora_inicio->format('H:i') }}</td> <!-- Hora inicio -->
                    <td class="border border-gray-300 p-2">{{ $clase->hora_fin->format('H:i') }}</td> <!-- Hora fin -->
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center p-4">No hay clases registradas</td>
                </tr>
            @endforelse
        </tbody>
        
    </table>
</div>
