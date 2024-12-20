<div>
    <div class="w-full flex justify-end items-center gap-4 p-4">
        <a href="{{ route('users-users-create') }}" class="bg-green-700 hover:bg-green-800 text-white font-bold py-2 px-4 rounded transition-colors shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
            Agregar Usuario
        </a>
    </div>

    <!-- Filtro por rol y búsqueda -->
    <div class="flex items-center gap-4 p-4">
        <input type="text" wire:model="search" placeholder="Buscar por nombre" class="border rounded p-2">
        
        <select wire:model="roleFilter" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"">
            <option value="">Seleccionar Rol</option>
            @foreach($roles as $role)
                <option value="{{ $role->name }}">{{ $role->name }}</option>
            @endforeach
        </select>
    </div>

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
            @foreach($users as $user)
                <tr wire:key="{{$user->id}}" class="bg-white border-b hover:bg-gray-50">
                    <td class="border border-gray-300 p-2 text-md text-black">{{ $user->id }}</td>
                    <td class="border border-gray-300 p-2 text-md text-black">{{ $user->name }}</td>
                    <td class="border border-gray-300 p-2 text-md text-black">{{ $user->apellido }}</td>
                    <td class="border border-gray-300 p-2 text-md text-black">{{ $user->email }}</td>
                    <td class="border border-gray-300 p-2 text-md text-black">{{ $user->getRoleNames()->first() }}</td>
                    <td class="border border-gray-300 p-2 text-center">
                        <div class="flex justify-center items-center gap-4">
                            <a href="{{ route('users-users-edit', $user->id) }}" class="text-blue-600 hover:text-blue-900">Editar</a>
                            <button wire:click="deleteUser({{ $user->id }})" wire:confirm="Desea dar de baja a este usuario" class="text-red-600 hover:text-red-900">Dar de baja</button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Paginación -->
    <div class="p-4">
        <nav class="flex justify-between items-center">
            <span>Mostrando {{ $pagination['current_page'] }} de {{ $pagination['last_page'] }} páginas</span>
            <div>
                @if($pagination['current_page'] > 1)
                    <button wire:click="loadUsers({{ $pagination['current_page'] - 1 }})">Anterior</button>
                @endif
                @if($pagination['current_page'] < $pagination['last_page'])
                    <button wire:click="loadUsers({{ $pagination['current_page'] + 1 }})">Siguiente</button>
                @endif
            </div>
        </nav>
    </div>

    @if ($editingUser)
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
                                Editar Usuario
                            </h3>
                            <div class="mt-2">
                                <input type="text" wire:model="name" class="border rounded p-2 w-full" placeholder="Nombre">
                                <input type="text" wire:model="apellido" class="border rounded p-2 w-full mt-2" placeholder="Apellido">
                                <input type="email" wire:model="email" class="border rounded p-2 w-full mt-2" placeholder="Email">
                                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                @error('apellido') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button wire:click="updateUser" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
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
