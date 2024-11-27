<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
    <form wire:submit.prevent="save">
        <!-- Etiqueta Nombre -->
        <div class="mb-4">
            <label for="nombre" class="block text-gray-700 font-semibold mb-2">Nombre</label>
            <input wire:model="nombre" type="text" name="nombre" id="nombre" 
                   class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                   placeholder="Ingrese el nombre del curso">
            @error('nombre')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <!-- Etiqueta Día -->
        <div class="mb-4">
            <label for="dia" class="block text-gray-700 font-semibold mb-2">Días</label>
            <input wire:model="dia" type="text" name="dia" id="dia" 
                   class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                   placeholder="Ingrese el día del curso">
            @error('dia')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        
      <!-- Etiqueta Horario -->
        <div class="mb-4">
            <label for="horario" class="block text-gray-700 font-semibold mb-2">Horario</label>
            <input wire:model="horario" type="time" name="horario" id="horario" 
                 class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                placeholder="Ingrese el horario del curso">
            @error('horario')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>


        <!-- Etiqueta Fecha de Inicio -->
        <div class="mb-4">
            <label for="fecha_inicio" class="block text-gray-700 font-semibold mb-2">Fecha de Inicio</label>
            <input wire:model="fecha_inicio" type="date" name="fecha_inicio" id="fecha_inicio" 
                   class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            @error('fecha_inicio')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <!-- Etiqueta Fecha de Fin -->
        <div class="mb-4">
            <label for="fecha_fin" class="block text-gray-700 font-semibold mb-2">Fecha de Fin</label>
            <input wire:model="fecha_fin" type="date" name="fecha_fin" id="fecha_fin" 
                   class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            @error('fecha_fin')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

         <!-- Etiqueta Profesor -->
         <div class="mb-4">
            <label for="profesor" class="block text-gray-700 font-semibold mb-2">Asignar Profesor</label>
            <select wire:model="profesor" name="profesor" id="profesor" 
                   class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @forelse ($misprofesores as $profe )
                    <option value="{{$profe->id}}">{{$profe->name}}</option>
                @empty
                    <option value="">Sin opciones</option>
                @endforelse
            </select>
            @error('fecha_fin')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <!-- Etiqueta Descripción -->
        <div class="mb-4">
            <label for="descripcion" class="block text-gray-700 font-semibold mb-2">Descripción</label>
            <textarea wire:model="descripcion" name="descripcion" id="descripcion" 
                      class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                      placeholder="Descripción del curso"></textarea>
            @error('descripcion')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <!-- Botones Cancelar y Guardar -->
        <div class="flex justify-center space-x-4">
            <a href="{{ route('cursos-cursos-index') }}" class="bg-red-500 text-white font-bold py-2 px-4 rounded hover:bg-red-600 transition-colors">
                Cancelar
            </a>
            <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600 transition-colors">
                Guardar
            </button>
        </div>
    </form>
</div>
