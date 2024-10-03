<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
    <form wire:submit.prevent="save" wire:confirm="¿Crear rol?">
        <!-- Etiqueta Nombre de Rol -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-semibold mb-2">Nombre de Rol</label>
            <input wire:model="name" type="text" name="name" id="name" 
                   class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                   placeholder="Ingrese el nombre del rol">
        </div>
        
        <!-- Botones Cancelar y Guardar -->
        <div class="flex justify-center space-x-4 ">
            <a href="" class="bg-red-500 text-white font-bold py-2 px-4 rounded hover:bg-red-600 transition-colors">
                Cancelar
            </a>
            <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600 transition-colors">
                Guardar
            </button>
        </div>
    </form>
</div>
