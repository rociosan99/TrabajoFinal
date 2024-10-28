<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
    <form wire:submit.prevent="save" wire:confirm="¿Crear usuario?">
        <!-- Etiqueta Nombre de Usuario -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-semibold mb-2">Nombre del Usuario</label>
            <input wire:model="name" type="text" name="name" id="name" 
                   class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                   placeholder="Ingrese el nombre del usuario" required>
        </div>

        <!-- Etiqueta Email -->
        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
            <input wire:model="email" type="email" name="email" id="email" 
                   class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                   placeholder="Ingrese el email del usuario" required>
        </div>

        <!-- Etiqueta Contraseña -->
        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-semibold mb-2">Contraseña</label>
            <input wire:model="password" type="password" name="password" id="password" 
                   class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                   placeholder="Ingrese la contraseña" required>
        </div>

        <!-- Botones Cancelar y Guardar -->
        <div class="flex justify-center space-x-4">
            <a href="{{ route('users-users-index')}}" class="bg-red-500 text-white font-bold py-2 px-4 rounded hover:bg-red-600 transition-colors">
                Cancelar
            </a>
            <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600 transition-colors">
                Guardar
            </button>
        </div>
    </form>
</div>

