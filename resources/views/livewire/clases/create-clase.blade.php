<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
    <form wire:submit.prevent="save">
        <!-- Etiqueta Fecha de la Clase -->
        <div class="mb-4">
            <label for="fecha_clase" class="block text-gray-700 font-semibold mb-2">Fecha de la Clase</label>
            <input wire:model="fecha_clase" type="date" name="fecha_clase" id="fecha_clase" 
                   class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            @error('fecha_clase')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <!-- Etiqueta Hora de Inicio -->
        <div class="mb-4">
            <label for="hora_inicio" class="block text-gray-700 font-semibold mb-2">Hora de Inicio</label>
            <input wire:model="hora_inicio" type="time" name="hora_inicio" id="hora_inicio" 
                   class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            @error('hora_inicio')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <!-- Etiqueta Hora de Fin -->
        <div class="mb-4">
            <label for="hora_fin" class="block text-gray-700 font-semibold mb-2">Hora de Fin</label>
            <input wire:model="hora_fin" type="time" name="hora_fin" id="hora_fin" 
                   class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            @error('hora_fin')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <!-- Etiqueta Curso -->
        <div class="mb-4">
            <label for="curso_id" class="block text-gray-700 font-semibold mb-2">Seleccionar Curso</label>
            <select wire:model="curso_id" name="curso_id" id="curso_id" 
                    class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @foreach ($cursos as $curso)
                    <option value="{{ $curso->id }}">{{ $curso->nombre }}</option>
                @endforeach
            </select>
            @error('curso_id')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <!-- Botones Cancelar y Guardar -->
        <div class="flex justify-center space-x-4">
            <a href="{{ route('clases-clases-index') }}" class="bg-red-500 text-white font-bold py-2 px-4 rounded hover:bg-red-600 transition-colors">
                Cancelar
            </a>
            <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600 transition-colors">
                Guardar
            </button>
        </div>
    </form>
</div>
