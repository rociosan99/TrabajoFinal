<div>
    <div class="w-full flex justify-end items-center gap-4 p-4">
        <a href="{{ route('users-roles-create') }}" class="bg-green-700 text-white font-bold py-2 px-4 rounded hover:bg-green-800 transition-colors">
            Nuevo Rol
        </a>
    </div>
    <table class="w-full border-collapse border border-gray-300 bg-white">
        <thead>
            <tr class="bg-blue-500 text-white">
                <th class="border border-gray-300 p-2 text-md">id</th>
                <th class="border border-gray-300 p-2 text-md">Nombre del Rol</th>
                <th class="border border-gray-300 p-2 text-md">Fecha de creación</th>
                <th class="border border-gray-300 p-2 text-md">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($roles as $role)
            <tr wire:key="{{ $role->id }}">
                <td class="border border-gray-300 p-2">{{ $role->id }}</td>
                <td class="border border-gray-300 p-2">{{ $role->name }}</td>
                <td class="border border-gray-300 p-2">{{ Date::parse($role->created_at)->format('d-m-Y') }}</td>
                <td class="border border-gray-300 p-2 text-center">
                    <div class="flex justify-center items-center gap-4">
                        <button wire:click="startEdit({{ $role->id }})" class="text-blue-600 hover:text-blue-900">Editar</button>
                        <button wire:click="deleteRole({{ $role->id }})" wire:confirm="Desea borrar este Rol" class="text-red-600 hover:text-red-900">Eliminar</button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="border border-gray-300 p-2 text-center"> 
                    <span>Sin registros</span>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if ($isEditing)
    <div class="mt-4">
        <form wire:submit.prevent="updateRole" class="space-y-4">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" id="name" wire:model="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 transition-colors">Actualizar</button>
            <button type="button" wire:click="resetForm" class="bg-gray-500 text-white font-bold py-2 px-4 rounded hover:bg-gray-700 transition-colors">Cancelar</button>
        </form>
    </div>
    @endif
</div>