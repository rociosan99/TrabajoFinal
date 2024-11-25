<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
    <form wire:submit.prevent="save">
        <!-- Tema -->
        <div class="mb-4">
            <label for="tema" class="block text-gray-700 font-semibold mb-2">Tema</label>
            <input wire:model="tema" type="text" name="tema" id="tema"
                   class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                   placeholder="Ingrese el tema del examen">
            @error('tema') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Fecha -->
        <div class="mb-4">
            <label for="fecha" class="block text-gray-700 font-semibold mb-2">Fecha del Examen</label>
            <input wire:model="fecha" type="date" name="fecha" id="fecha"
                   class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            @error('fecha') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Curso -->
        <div class="mb-4">
            <label for="curso_id" class="block text-gray-700 font-semibold mb-2">Curso</label>
            <select wire:model="curso_id" name="curso_id" id="curso_id"
                    class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">Seleccione un curso</option>
                @foreach($cursos as $curso)
                    <option value="{{ $curso->id }}">{{ $curso->nombre }}</option>
                @endforeach
            </select>
            @error('curso_id') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Botones Cancelar y Guardar -->
        <div class="flex justify-center space-x-4">
            <a href="{{ route('examenes-examenes-index') }}" class="bg-red-500 text-white font-bold py-2 px-4 rounded hover:bg-red-600 transition-colors">
                Cancelar
            </a>
            <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600 transition-colors">
                Crear Examen
            </button>
        </div>
    </form>
</div>
