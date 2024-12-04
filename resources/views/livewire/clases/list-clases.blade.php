<div>
    <!-- Botón para agregar una nueva clase -->
    <div class="w-full flex justify-end items-center gap-4 p-4">
        <a href="{{ route('clases-clases-create') }}" class="bg-green-700 hover:bg-green-800 text-white font-bold py-2 px-4 rounded transition-colors shadow-lg transform hover:scale-105">
            Agregar Clase
        </a>
    </div>

    <!-- Mostrar cantidad de clases -->
    <div class="p-4">
        <h3 class="text-lg font-medium text-gray-900">Cantidad de clases: {{ $clases->count() }}</h3>
    </div>

    <!-- Tabla para mostrar las clases -->
    <table class="w-full border-collapse border border-gray-300 bg-white">
        <thead>
            <tr class="bg-blue-500 text-white">
                <th class="border border-gray-300 p-2 text-md">ID</th>
                <th class="border border-gray-300 p-2 text-md">Curso</th>
                <th class="border border-gray-300 p-2 text-md">Fecha</th>
                <th class="border border-gray-300 p-2 text-md">Hora Inicio</th>
                <th class="border border-gray-300 p-2 text-md">Hora Fin</th>
                <th class="border border-gray-300 p-2 text-md">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clases as $clase)
                <tr wire:key="{{ $clase->id }}" class="bg-white border-b hover:bg-gray-50">
                    <td class="border border-gray-300 p-2 text-md text-black">{{ $clase->id }}</td>
                    <td class="border border-gray-300 p-2 text-md text-black">{{ $clase->curso->nombre }}</td>
                    <td class="border border-gray-300 p-2 text-md text-black">
                        {{ \Carbon\Carbon::parse($clase->fecha_clase)->format('d-m-Y') }}
                    </td>
                    <td class="border border-gray-300 p-2 text-md text-black">{{ $clase->hora_inicio }}</td>
                    <td class="border border-gray-300 p-2 text-md text-black">{{ $clase->hora_fin }}</td>
                    <td class="border border-gray-300 p-2 text-center">
                        <div class="flex justify-center items-center gap-4">
                            <a href="{{ route('clases-clases-edit', $clase->id) }}" class="text-blue-600 hover:text-blue-900">Editar</a>
                            <button wire:click="deleteClase({{ $clase->id }})" wire:confirm="¿Desea borrar esta clase?" class="text-red-600 hover:text-red-900">Eliminar</button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal para editar una clase -->
    @if ($editingClase)
        <div class="fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true"></span>

                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Editar Clase
                                </h3>
                                <div class="mt-2">
                                    <!-- Entrada para fecha, hora de inicio y hora de fin -->
                                    <input type="date" wire:model="fecha_clase" class="border rounded p-2 w-full">
                                    <input type="time" wire:model="hora_inicio" class="border rounded p-2 w-full mt-2">
                                    <input type="time" wire:model="hora_fin" class="border rounded p-2 w-full mt-2">
                                    
                                    <!-- Mensajes de error -->
                                    @error('fecha_clase') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    @error('hora_inicio') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    @error('hora_fin') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button wire:click="updateClase" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700">
                            Guardar
                        </button>
                        <button wire:click="resetForm" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-gray-600 text-base font-medium text-white hover:bg-gray-700">
                            Cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
