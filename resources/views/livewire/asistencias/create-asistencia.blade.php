<div>
    <h1 class="text-lg font-bold mb-4">Registrar Asistencia</h1>
    
    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-2 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 px-4 py-2">Nombre</th>
                <th class="border border-gray-300 px-4 py-2">Apellido</th>
                <th class="border border-gray-300 px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($alumnos as $alumno)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $alumno->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $alumno->apellido }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <label class="inline-flex items-center">
                            <input type="radio" wire:model="asistencias.{{ $alumno->id }}" value="presente" class="mr-2">
                            Presente
                        </label>
                        <label class="inline-flex items-center ml-4">
                            <input type="radio" wire:model="asistencias.{{ $alumno->id }}" value="ausente" class="mr-2">
                            Ausente
                        </label>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <button wire:click="guardarAsistencias" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">
        Guardar Asistencias
    </button>
</div>
