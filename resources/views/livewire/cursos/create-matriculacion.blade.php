<div class="p-6">
    <!-- Botón para volver atrás -->
    <div class="mb-4">
        <a href="{{ route('cursos-cursos-index') }}" class="inline-flex items-center text-blue-500 hover:text-blue-700 font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Volver a cursos
        </a>
    </div>

    <!-- Título -->
    <h2 class="text-2xl font-bold mb-4">Matriculación de Alumnos</h2>

    <!-- Mostrar mensajes de error -->
    @if (session()->has('error'))
        <div class="bg-red-500 text-white p-4 mb-4 rounded">
            {{ session('error') }}
        </div>
    @endif

    <!-- Campo de búsqueda -->
    <div class="flex items-center space-x-2 mb-4">
        <input 
            type="text" 
            wire:model.debounce.500ms="search" 
            placeholder="Buscar por nombre..." 
            class="p-2 border rounded-md shadow-md w-full"
        />
        <button 
            wire:click="buscarAlumnos" 
            class="p-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md shadow-md transition duration-300 ease-in-out transform hover:scale-105"
        >
            <i class="fas fa-search"></i>
        </button>
    </div>

    <!-- Tabla de alumnos disponibles -->
    <div class="mb-6">
        <h3 class="text-xl font-semibold mb-2">Alumnos Disponibles</h3>

        <table class="w-full border-collapse border border-gray-300 bg-white">
            <thead>
                <tr class="bg-blue-500 text-white">
                    <th class="border border-gray-300 p-2 text-md">ID</th>
                    <th class="border border-gray-300 p-2 text-md">Nombre</th>
                    <th class="border border-gray-300 p-2 text-md">Apellido</th>
                    <th class="border border-gray-300 p-2 text-md">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($alumnos as $alumno)
                    <tr wire:key="disponible-{{ $alumno->id }}" class="hover:bg-gray-50">
                        <td class="border border-gray-300 p-2 text-md">{{ $alumno->id }}</td>
                        <td class="border border-gray-300 p-2 text-md">{{ $alumno->name }}</td>
                        <td class="border border-gray-300 p-2 text-md">{{ $alumno->apellido }}</td>
                        <td class="border border-gray-300 p-2 text-md flex items-center justify-center">
                            <button 
                                wire:click="addToList({{ $alumno->id }})" 
                                class="flex items-center justify-center text-green-500 text-2xl w-10 h-10">
                                &plus;
                            </button>  
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Tabla de alumnos a matricular -->
    <div class="mb-6">
        <h3 class="text-xl font-semibold mb-2">Alumnos a Matricular</h3>

        <table class="w-full border-collapse border border-gray-300 bg-white">
            <thead>
                <tr class="bg-blue-500 text-white">
                    <th class="border border-gray-300 p-2 text-md">ID</th>
                    <th class="border border-gray-300 p-2 text-md">Nombre</th>
                    <th class="border border-gray-300 p-2 text-md">Apellido</th>
                    <th class="border border-gray-300 p-2 text-md">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($alumnos_matricular as $alumno)
                    <tr wire:key="matriculado-{{ $alumno['id'] }}" class="hover:bg-gray-50">
                        <td class="border border-gray-300 p-2 text-md">{{ $alumno['id'] }}</td>
                        <td class="border border-gray-300 p-2 text-md">{{ $alumno['name'] }}</td>
                        <td class="border border-gray-300 p-2 text-md">{{ $alumno['apellido'] }}</td>
                        <td class="border border-gray-300 p-2 text-md flex items-center justify-center">
                            <button 
                                wire:click="deleteToList({{ $alumno['id'] }})" 
                                class="text-red-500 text-xl">
                                &#120;
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Botones de acción -->
    <div class="flex justify-center mt-4">
        <button 
            wire:click="matricularAlumnos" 
            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-4">
            Matricular
        </button>
        <a href="{{ route('cursos-cursos-index') }}" 
           class="bg-red-500 text-white font-bold py-2 px-4 rounded hover:bg-red-600">
            Cancelar
        </a>
    </div>
</div>
