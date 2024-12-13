<div>
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        <form wire:submit.prevent="save">
            <!-- Nombre -->
            <div class="mb-4">
                <label for="nombre" class="block text-gray-700 font-semibold mb-2">Nombre</label>
                <input wire:model="nombre" type="text" id="nombre" 
                       class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                       placeholder="Ingrese el nombre del curso">
                @error('nombre') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- agregar dia -->
            <div class="mb-4 flex gap-1 justify-between items-center border border-neutral-200 p-1">
                <span class="text-gray-700 font-semibold">Agregar dia</span>
                <span wire:click="addInput" class="text-gray-700 font-semibold text-md px-1 py-0.5 bg-emerald-300 border-emerald-400 border rounded-sm cursor-pointer">&plus;</span>
            </div>
              
            @if($dias_is_empty)
                <span class="text-sm text-red-600">Tiene que darles dias y horarios al curso</span>
            @endif

            @foreach ( $dias as $key => $dia )
                <!-- horarios por dia -->
                <div class="mb-4 flex gap-1 justify-start items-center border border-neutral-200 p-1">
                    <!-- Días -->
                    <div class="mb-4 grow">
                        <label for="dia" class="block text-gray-700 font-semibold mb-2">Dia</label>
                        <select id="dias_{{$key}}_dia" wire:model.defer="dias.{{$key}}.dia" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option @selected(true) value="">seleccione un dia</option>
                            @foreach($dias_select as $dia_select)
                                <option value="{{$dia_select}}">{{$dia_select}}</option>
                            @endforeach
                        </select>
                        @error('dias.'. $key . '.dia') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>
                    
                    <!-- Hora de Inicio -->
                    <div class="mb-4">
                        <label for="hora_inicio" class="block text-gray-700 font-semibold mb-2">Hora de Inicio</label>
                        <input wire:model.defer="dias.{{$key}}.hora_inicio" type="time" id="dias_{{$key}}_hora_inicio" 
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('dias.'. $key . '.hora_inicio') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>
            
                    <!-- Hora de Fin -->
                    <div class="mb-4">
                        <label for="hora_fin" class="block text-gray-700 font-semibold mb-2">Hora de Fin</label>
                        <input wire:model.defer="dias.{{$key}}.hora_fin" type="time" id="dias_{{$key}}_hora_fin" 
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('dias.'. $key . '.hora_fin') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <!-- Icono de eliminar -->
                    <div class="ml-2">
                        <button type="button" wire:click="removeInput({{ $key }})" 
                                class="text-red-600 hover:text-red-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
            @endforeach
            
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
</div>
