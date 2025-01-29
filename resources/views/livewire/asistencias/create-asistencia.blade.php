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

    <!-- Tabla de asistencia -->
    <h1 class="text-lg font-bold mb-4">Registrar Asistencia</h1>

    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-2 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <table class="w-full border-collapse border border-gray-500 bg-white">
        <thead>
            <tr class="bg-blue-500 text-white">
                <th class="px-2 py-2">Nombre</th>
                <th class="px-2 py-2">Apellido</th>
                <th class="px-2 py-2">Presente</th>
            </tr>
        </thead>
        <tbody>
            @forelse($alumnos as $alumno)
                <tr>
                    <td class="border border-gray-300 text-center px-2 py-2">{{ $alumno->name }}</td>
                    <td class="border border-gray-300 text-center px-2 py-2">{{ $alumno->apellido }}</td>
                    <td class="border border-gray-300 text-center px-2 py-2">
                        <input type="checkbox" wire:model="asistencias.{{ $alumno->id }}" class="form-checkbox h-5 w-5 text-blue-600">
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center border border-gray-300 px-2 py-1">No hay alumnos registrados</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Botón de guardar -->
    <div class="flex justify-center mt-6">
        <button wire:click="guardarAsistencias" 
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Guardar Asistencias
        </button>
    </div>
    
</div>
