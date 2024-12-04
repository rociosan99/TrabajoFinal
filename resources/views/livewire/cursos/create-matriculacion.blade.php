<div>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold text-gray-700 mb-4">Lista de Usuarios</h1>
        
        <!-- Mostrar mensaje de error si el alumno ya está matriculado en otro curso -->
        @if (session()->has('error'))
            <div class="mt-4 bg-red-200 text-red-700 p-2 rounded-md">
                {{ session('error') }}
            </div>
        @endif

        <table class="min-w-full bg-white border border-gray-300 rounded-md shadow-lg">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 text-left text-gray-700 font-medium border-b">ID</th>
                    <th class="px-4 py-2 text-left text-gray-700 font-medium border-b">Nombre</th>
                    <th class="px-4 py-2 text-left text-gray-700 font-medium border-b">Apellido</th>
                    <th class="px-4 py-2 text-center text-gray-700 font-medium border-b">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($alumnos as $alumno)
                <tr wire:key="alumno-{{$alumno->id}}">
                    <td class="px-4 py-2 border-b text-gray-600">{{$alumno->id}}</td>
                    <td class="px-4 py-2 border-b text-gray-600">{{$alumno->name}}</td>
                    <td class="px-4 py-2 border-b text-gray-600">{{$alumno->apellido}}</td>
                    <td class="px-4 py-2 border-b text-center">
                        <span wire:click="addToList({{$alumno->id}})" 
                              class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 cursor-pointer">
                            Elegir
                        </span>
                        <span wire:click="deleteToList({{$alumno->id}})" 
                              class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 cursor-pointer">
                            Quitar
                        </span>
                    </td>
                </tr> 
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-2 text-center text-gray-600">No hay alumnos</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <h2 class="text-xl font-bold text-gray-700 mb-2">IDs seleccionados:</h2>
        @if (count($alumnos_matricular) > 0)
            <ul class="list-disc pl-6">
                @foreach ($alumnos_matricular as $id)
                    <li class="text-gray-600 flex items-center">
                        Alumno ID: {{$id}}
                        <span wire:click="deleteToList({{$id}})" 
                              class="ml-4 bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 cursor-pointer">
                            Quitar
                        </span>
                    </li>
                @endforeach
            </ul>
            <button wire:click="matricularAlumnos" 
                    class="mt-4 bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400">
                Matricular
            </button>
        @else
            <p class="text-gray-600">No se han seleccionado alumnos aún.</p>
        @endif
    </div>

    @if (session()->has('message'))
        <div class="mt-4 bg-green-200 text-green-700 p-2 rounded-md">
            {{ session('message') }}
        </div>
    @endif
</div>
