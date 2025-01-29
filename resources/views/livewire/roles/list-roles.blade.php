<div>
    <!-- Botón Volver al inicio -->
    <div class="mb-2">
        <a href="{{ route('admin.dashboard') }}" 
           class="inline-flex items-center text-blue-500 hover:text-blue-700 font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" 
                 class="w-5 h-5 mr-2" 
                 fill="none" 
                 viewBox="0 0 24 24" 
                 stroke="currentColor">
                <path stroke-linecap="round" 
                      stroke-linejoin="round" 
                      stroke-width="2" 
                      d="M15 19l-7-7 7-7"></path>
            </svg>
            Volver al inicio
        </a>
    </div>

    <!-- Filtro por nombre de rol -->
    <div class="flex flex-col md:flex-row items-center justify-between gap-4 p-4">
        <!-- Filtro por nombre de rol -->
        <div class="flex items-center space-x-2">
            <input 
                type="text" 
                wire:model="search" 
                placeholder="Buscar rol..." 
                class="p-2 border rounded-md shadow-md w-72"  <!-- Ampliado tamaño del campo -->
            <button 
                wire:click="loadRoles" 
                class="p-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md shadow-md transition duration-300 ease-in-out transform hover:scale-105"
            >
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>

    <!-- Tabla de roles -->
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
                <td class="border border-gray-300 p-2">{{ \Carbon\Carbon::parse($role->created_at)->format('d-m-Y') }}</td>
                <td class="border border-gray-300 p-2 text-center">
                    <div class="flex justify-center items-center gap-4">
                        <button wire:click="startEdit({{ $role->id }})" class="text-blue-600 hover:text-blue-900">Editar</button>
                        <button wire:click="deleteRole({{ $role->id }})" wire:confirm="Desea dar de baja este Rol" class="text-red-600 hover:text-red-900">Dar de baja</button>
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
