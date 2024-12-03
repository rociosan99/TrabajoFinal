<div>
    <!-- Mensaje de éxito -->
    @if (session()->has('message'))
        <div class="p-4 mb-4 text-sm text-green-600 bg-green-100 rounded">
            {{ session('message') }}
        </div>
    @endif

    <!-- Botón para agregar una nueva justificación -->
    <div class="w-full flex justify-end items-center gap-4 p-4">
        <button wire:click="$set('descripcion', '')" class="bg-green-700 hover:bg-green-800 text-white font-bold py-2 px-4 rounded transition-colors shadow-lg transform hover:scale-105">
            Agregar Justificación
        </button>
    </div>

    <!-- Formulario para agregar una nueva justificación -->
    <div class="p-4 bg-white border rounded shadow-lg mb-4">
        <form wire:submit.prevent="store">
            <label for="descripcion" class="block text-sm font-medium text-gray-700">Motivo de Inasistencia</label>
            <textarea id="descripcion" wire:model="descripcion" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
            @error('descripcion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            <button type="submit" class="mt-4 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700">
                Guardar
            </button>
        </form>
    </div>

    <!-- Tabla de motivos de inasistencia -->
    <table class="w-full border-collapse border border-gray-300 bg-white">
        <thead>
            <tr class="bg-blue-500 text-white">
                <th class="border border-gray-300 p-2 text-md">ID</th>
                <th class="border border-gray-300 p-2 text-md">Motivo</th>
                <th class="border border-gray-300 p-2 text-md">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($motivos as $motivo)
                <tr wire:key="{{ $motivo->id }}" class="bg-white border-b hover:bg-gray-50">
                    <td class="border border-gray-300 p-2 text-md text-black">{{ $motivo->id }}</td>
                    <td class="border border-gray-300 p-2 text-md text-black">{{ $motivo->descripcion }}</td>
                    <td class="border border-gray-300 p-2 text-center">
                        <button wire:click="delete({{ $motivo->id }})" class="text-red-600 hover:text-red-900">Eliminar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
