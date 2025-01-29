<div>
    <!-- Botón Volver al inicio -->
    <div class="mb-2">
        <a href="{{ route('admin.dashboard') }}"
            class="inline-flex items-center text-blue-500 hover:text-blue-700 font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Volver al inicio
        </a>
    </div>

    <!-- Filtro por nombre y rol -->
    <div class="flex flex-col md:flex-row items-center justify-between gap-4 p-4">
        <!-- Filtro por nombre con lupa -->
        <div class="flex items-center space-x-2">
            <input type="text" wire:model="search" placeholder="Buscar por nombre..."
                class="p-2 border rounded-md shadow-md w-72" <!-- Ampliado tamaño del campo -->
            <button wire:click="buscarUsuarios"
                class="p-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md shadow-md transition duration-300 ease-in-out transform hover:scale-105">
                <i class="fas fa-search"></i>
            </button>
        </div>

        <!-- Filtro por rol con lupa -->
        <div class="flex items-center space-x-2">
            <select wire:model="roleFilter"
                class="p-2 border rounded-md shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500 w-72">
                <!-- Ampliado tamaño del campo -->
                <option value="">Seleccionar Rol</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
            </select>
            <button wire:click="buscarUsuariosPorRol"
                class="p-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md shadow-md transition duration-300 ease-in-out transform hover:scale-105">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>

    <!-- Tabla de usuarios -->
    <table class="w-full border-collapse border border-gray-300 bg-white">
        <thead>
            <tr class="bg-blue-500 text-white">
                <th class="border border-gray-300 p-2 text-md">ID</th>
                <th class="border border-gray-300 p-2 text-md">Nombre</th>
                <th class="border border-gray-300 p-2 text-md">Apellido</th>
                <th class="border border-gray-300 p-2 text-md">Email</th>
                <th class="border border-gray-300 p-2 text-md">Rol</th>
                <th class="border border-gray-300 p-2 text-md">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr wire:key="{{ $user->id }}" class="bg-white border-b hover:bg-gray-50">
                    <td class="border border-gray-300 p-2 text-md text-black">{{ $user->id }}</td>
                    <td class="border border-gray-300 p-2 text-md text-black">{{ $user->name }}</td>
                    <td class="border border-gray-300 p-2 text-md text-black">{{ $user->apellido }}</td>
                    <td class="border border-gray-300 p-2 text-md text-black">{{ $user->email }}</td>
                    <td class="border border-gray-300 p-2 text-md text-black">{{ $user->getRoleNames()->first() }}</td>
                    <td class="border border-gray-300 p-2 text-center">
                        <div class="flex justify-center items-center gap-4">
                            <a href="{{ route('users-users-edit', $user->id) }}"
                                class="text-blue-600 hover:text-blue-900">Editar</a>
                            <button wire:click="deleteUser({{ $user->id }})"
                                class="text-red-600 hover:text-red-900">Dar de baja</button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center p-4 text-gray-500">No se encontraron resultados</td>
                </tr>
            @endforelse
        </tbody>
    </table>


    <!-- Paginación -->
    <div class="p-4 flex justify-center bg-white">>
        {{ $users->links() }}
    </div>
</div>
