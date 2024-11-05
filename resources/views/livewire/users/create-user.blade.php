<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
    <form wire:submit.prevent="save" wire:confirm="¿Crear usuario?">
        <!-- Etiqueta Nombre de Usuario -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-semibold mb-2">Nombre</label>
            <input wire:model="name" type="text" name="name" id="name" 
                   class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                   placeholder="Ingrese el nombre y apellido del usuario">
            @error('name')
                <span class="text-sm text-red-600">
                    {{$message}}
                </span>
            @enderror
        </div>
        <!--etiqueta Apellido-->
        <div class="mb-4">
            <label for="apellido" class="block text-gray-700 font-semibold mb-2">Apellido</label>
            <input wire:model="apellido" type="text" name="apellido" id="apellido" 
                   class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                   placeholder="Ingrese el apellido del usuario" >
            @error('apellido')
                <span>
                    {{$message}}
                </span>
            @enderror
        </div>
        

         <!-- Etiqueta dni -->
         <div class="mb-4">
            <label for="dni" class="block text-gray-700 font-semibold mb-2">Dni</label>
            <input wire:model="dni" type="text" name="dni" id="dni" 
                   class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                   placeholder="Ingrese el dni del usuario" >
            @error('dni')
                <span>
                    {{$message}}
                </span>
            @enderror
        </div>

         <!-- Etiqueta Fecha Nacimiento -->
         <div class="mb-4">
            <label for="fecha_nac" class="block text-gray-700 font-semibold mb-2">Fecha de Nacimiento</label>
            <input wire:model="fecha_nac" type="date" name="fecha_nac" id="fecha_nac" 
                   class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                   placeholder="Ingrese su fecha de nacimiento">
             @error('fecha_nac')
                <span>
                    {{$message}}
                </span>
            @enderror
        </div>

        <!-- Etiqueta Email -->
        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
            <input wire:model="email" type="email" name="email" id="email" 
                   class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                   placeholder="Ingrese el email del usuario">
            @error('email')
                <span>
                    {{$message}}
                </span>
            @enderror
        </div>

        <!-- Etiqueta Contraseña -->
        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-semibold mb-2">Contraseña</label>
            <input wire:model="password" type="password" name="password" id="password" 
                   class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                   placeholder="Ingrese la contraseña">
            @error('password')
                <span>
                    {{$message}}
                </span>
            @enderror
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

