<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
    <form wire:submit.prevent="edit">
        <!-- Nombre -->
        <div class="mb-4">
            <label for="nombre" class="block text-gray-700 font-semibold mb-2">Nombre</label>
            <input wire:model="nombre" type="text" id="nombre" 
                   class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                   placeholder="Ingrese el nombre del curso">
            @error('nombre') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Días -->
<div class="mb-4">
    <label for="dia" class="block text-gray-700 font-semibold mb-2">Días</label>
    <div class="flex flex-wrap gap-2">
        @foreach (['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'] as $day)
            <label class="inline-flex items-center">
                <!-- Asegúrate de que cada checkbox tenga su propio valor específico dentro del arreglo -->
                <input wire:model="dia.{{ $day }}" type="checkbox" value="{{ $day }}" 
                       class="form-checkbox text-blue-500">
                <span class="ml-2">{{ $day }}</span>
            </label>
        @endforeach
    </div>
    @error('dia') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
</div>

        

        <!-- Hora de Inicio -->
        <div class="mb-4">
            <label for="hora_inicio" class="block text-gray-700 font-semibold mb-2">Hora de Inicio</label>
            <input wire:model="hora_inicio" type="time" id="hora_inicio" 
                   class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('hora_inicio') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Hora de Fin -->
        <div class="mb-4">
            <label for="hora_fin" class="block text-gray-700 font-semibold mb-2">Hora de Fin</label>
            <input wire:model="hora_fin" type="time" id="hora_fin" 
                   class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('hora_fin') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Fecha de Inicio -->
        <div class="mb-4">
            <label for="fecha_inicio" class="block text-gray-700 font-semibold mb-2">Fecha de Inicio</label>
            <input wire:model="fecha_inicio" type="date" id="fecha_inicio" 
                   class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('fecha_inicio') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Fecha de Fin -->
        <div class="mb-4">
            <label for="fecha_fin" class="block text-gray-700 font-semibold mb-2">Fecha de Fin</label>
            <input wire:model="fecha_fin" type="date" id="fecha_fin" 
                   class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('fecha_fin') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Profesor -->
        <div class="mb-4">
            <label for="profesor" class="block text-gray-700 font-semibold mb-2">Asignar Profesor</label>
            <select wire:model="profesor" id="profesor" 
                    class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Seleccione un profesor</option>
                @foreach ($misprofesores as $profe)
                    <option value="{{ $profe->id }}">{{ $profe->name }}</option>
                @endforeach
            </select>
            @error('profesor') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Descripción -->
        <div class="mb-4">
            <label for="descripcion" class="block text-gray-700 font-semibold mb-2">Descripción</label>
            <textarea wire:model="descripcion" id="descripcion" 
                      class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                      placeholder="Descripción del curso"></textarea>
            @error('descripcion') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Botones -->
        <div class="flex justify-between">
            <a href="{{ route('cursos-cursos-index') }}" 
               class="bg-red-500 text-white font-bold py-2 px-4 rounded hover:bg-red-600">
                Cancelar
            </a>
            <button type="submit" 
                    class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600">
                Guardar
            </button>
        </div>
    </form>
</div>
