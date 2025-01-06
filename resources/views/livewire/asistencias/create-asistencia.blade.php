<div class="container mx-auto mt-6">
    <h2 class="text-xl font-bold mb-4">Registrar Asistencia para el curso: {{ $cursoId }}</h2>

    <form wire:submit.prevent="saveAsistencias" class="bg-white p-6 rounded shadow-md">
        <div>
            <h3 class="text-lg font-semibold mb-4">Alumnos:</h3>
            @foreach($alumnos as $alumno)
                <div class="mb-2 flex items-center">
                    <input 
                        type="checkbox" 
                        wire:model="asistencias.{{ $alumno->id }}" 
                        value="presente" 
                        id="alumno-{{ $alumno->id }}" 
                        class="mr-2">
                    <label for="alumno-{{ $alumno->id }}" class="text-gray-700">{{ $alumno->name }} - Presente</label>
                </div>
            @endforeach
        </div>

        <button type="submit" 
                class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Guardar Asistencias
        </button>
    </form>

    @if (session()->has('message'))
        <div class="mt-4 p-4 text-green-700 bg-green-100 rounded">
            {{ session('message') }}
        </div>
    @endif
</div>
