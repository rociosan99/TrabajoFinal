<div>
    <div class="w-full flex justify-end items-center gap-4 p-4">
        <a href="{{ route('cursos-cursos-create') }}" class="bg-green-700 hover:bg-green-800 text-white font-bold py-2 px-4 rounded transition-colors shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
            Agregar Curso
        </a>
    </div>
    <table class="w-full border-collapse border border-gray-300 bg-white">
        <thead>
            <tr class="bg-blue-500 text-white">
                <th class="border border-gray-300 p-2 text-md">ID</th>
                <th class="border border-gray-300 p-2 text-md">Nombre</th>
                <th class="border border-gray-300 p-2 text-md">Días</th>
                <th class="border border-gray-300 p-2 text-md">Horario</th>
                <th class="border border-gray-300 p-2 text-md">Profesor</th>
                <th class="border border-gray-300 p-2 text-md">Fecha Inicio</th>
                <th class="border border-gray-300 p-2 text-md">Fecha Fin</th>
                <th class="border border-gray-300 p-2 text-md">Descripción</th>
                <th class="border border-gray-300 p-2 text-md">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cursos as $curso)
                <tr wire:key="{{$curso->id}}" class="bg-white border-b hover:bg-gray-50">
                    <td class="border border-gray-300 p-2 text-md text-black">{{ $curso->id }}</td>
                    <td class="border border-gray-300 p-2 text-md text-black">{{ $curso->nombre }}</td>
                    <td class="border border-gray-300 p-2 text-md text-black">{{ $curso->dia }}</td>
                    <td class="border border-gray-300 p-2 text-md text-black">{{ $curso->horario }}</td>
                    <td class="border border-gray-300 p-2 text-md text-black">{{ $curso->usuario->name }}</td>
                    <td class="border border-gray-300 p-2 text-md text-black">{{ $curso->fecha_inicio->format("d-m-Y")}}</td>
                    <td class="border border-gray-300 p-2 text-md text-black">{{ $curso->fecha_fin->format("d-m-Y") }}</td"">
                    <td class="border border-gray-300 p-2 text-md text-black">{{ $curso->descripcion }}</td>
                    <td class="border border-gray-300 p-2 text-center">
                        <div class="flex justify-center items-center gap-4">
                            <a href="{{ route('cursos-cursos-edit', $curso->id) }}" class="text-blue-600 hover:text-blue-900">Editar</a>
                            <button wire:click="deleteCurso({{ $curso->id }})" wire:confirm="¿Desea borrar este Curso?" class="text-red-600 hover:text-red-900">Eliminar</button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if ($editingCurso)
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
                                Editar Curso
                            </h3>
                            <div class="mt-2">
                                <input type="text" wire:model="nombre" class="border rounded p-2 w-full" placeholder="Nombre del Curso">
                                <input type="text" wire:model="dia" class="border rounded p-2 w-full mt-2" placeholder="Día">
                                <input type="text" wire:model="horario" class="border rounded p-2 w-full mt-2" placeholder="Horario">
                                <input type="text" wire:model="nivel" class="border rounded p-2 w-full mt-2" placeholder="Nivel">
                                <input type="date" wire:model="fecha_inicio" class="border rounded p-2 w-full mt-2">
                                <input type="date" wire:model="fecha_fin" class="border rounded p-2 w-full mt-2">
                                <textarea wire:model="descripcion" class="border rounded p-2 w-full mt-2" placeholder="Descripción"></textarea>
                                @error('nombre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                @error('dia') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                @error('horario') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                @error('nivel') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                @error('fecha_inicio') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                @error('fecha_fin') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                @error('descripcion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button wire:click="updateCurso" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Guardar
                    </button>
                    <button wire:click="resetForm" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
