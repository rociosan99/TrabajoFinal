<div>
    <!-- Botón para agregar un nuevo examen -->
    <div class="w-full flex justify-end items-center gap-4 p-4">
        <a href="{{ route('examenes-examenes-create') }}"" class="bg-green-700 text-white font-bold py-2 px-4 rounded hover:bg-green-800 transition-colors">
            Nuevo Examen
        </a>
    </div>

    <!-- Tabla para listar exámenes -->
    <table class="w-full border-collapse border border-gray-300 bg-white">
        <thead>
            <tr class="bg-blue-500 text-white">
                <th class="border border-gray-300 p-2 text-md">ID</th>
                <th class="border border-gray-300 p-2 text-md">Tema</th>
                <th class="border border-gray-300 p-2 text-md">Fecha</th>
                <th class="border border-gray-300 p-2 text-md">Curso</th>
                <th class="border border-gray-300 p-2 text-md">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($examenes as $examen)
            <tr wire:key="{{ $examen->id }}">
                <td class="border border-gray-300 p-2">{{ $examen->id }}</td>
                <td class="border border-gray-300 p-2">{{ $examen->tema }}</td>
                <td class="border border-gray-300 p-2">{{ \Carbon\Carbon::parse($examen->fecha)->format('d-m-Y') }}</td>
                <td class="border border-gray-300 p-2">{{ $examen->curso->nombre }}</td>
                <td class="border border-gray-300 p-2 text-center">
                    <div class="flex justify-center items-center gap-4">
                        <button wire:click="editExamen({{ $examen->id }})" class="text-blue-600 hover:text-blue-900">Editar</button>
                        <button wire:click="deleteExamen({{ $examen->id }})" wire:confirm="¿Desea borrar este examen?" class="text-red-600 hover:text-red-900">Eliminar</button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="border border-gray-300 p-2 text-center">
                    <span>Sin registros</span>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Formulario para editar examen -->
   @if ($isEditing)
    <div class="mt-4">
        <form wire:submit.prevent="updateExamen" class="space-y-4">
            <div>
                <label for="tema" class="block text-sm font-medium text-gray-700">Tema</label>
                <input type="text" id="tema" wire:model="tema" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                @error('tema') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha</label>
                <input type="date" id="fecha" wire:model="fecha" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                @error('fecha') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 transition-colors">Actualizar</button>
            <button type="button" wire:click="resetForm" class="bg-gray-500 text-white font-bold py-2 px-4 rounded hover:bg-gray-700 transition-colors">Cancelar</button>
        </form>
    </div>-->
    @endif
</div>
