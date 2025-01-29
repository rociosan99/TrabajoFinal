<div>
    <div class="mb-4">
        <a href="{{ route('cursos-cursos-index') }}"
            class="inline-flex items-center text-blue-500 hover:text-blue-700 font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Volver a cursos
        </a>
    </div>

    <!-- Campo para seleccionar si hubo clases -->
    <div class="mb-6">
        <label class="block text-gray-700 font-medium mb-2" for="dictado">
            ¿Se dictó la clase?
        </label>
        <select id="dictado" wire:model="dictado"
            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">Seleccione una opción</option>
            <option value="1">Sí</option>
            <option value="0">No</option>
        </select>
    </div>

    <div class="mb-6" id="motivo">
        <label for="observacion" class="block text-gray-700 font-medium mb-2">
            Motivo por el cual no hubo clases
        </label>
        <textarea id="observacion" wire:model.defer="observacion"
            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Describa el motivo aquí..."></textarea>
        <button wire:click="guardarMotivo()"
            class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Guardar Motivo
        </button>
    </div>


    <!-- Tabla de clases -->
    <table class="w-full border-collapse border border-gray-500 bg-white">
        <thead>
            <tr class="bg-blue-500 text-white">
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Fecha</th>
                <th class="px-4 py-2">Hora Inicio</th>
                <th class="px-4 py-2">Hora Fin</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($clases as $clase)
                <tr>
                    <td class="border border-gray-300 text-center py-4 px-4">{{ $clase->id }}</td>
                    <td class="border border-gray-300 text-center py-4 px-4">{{ $clase->fecha_clase->format('d-m-Y') }}
                    </td>
                    <td class="border border-gray-300 text-center py-4 px-4">{{ $clase->hora_inicio->format('H:i') }}
                    </td>
                    <td class="border border-gray-300 text-center py-4 px-4">{{ $clase->hora_fin->format('H:i') }}</td>
                    <td class="border border-gray-300 text-center py-4 px-4">
                        <!-- Botón de Asistencias -->
                        <a href="{{ route('asistencias-asistencias-create', $clase->id) }}"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Asistencias
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center border border-gray-300 py-4">
                        No hay clases registradas
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#motivo').hide();
            $('#dictado').on('change', function(event) {
                if ($(this).val() == '0') {
                    $('#motivo').show();
                } else {
                    $('#motivo').hide();
                }
            });
        });
    </script>
</div>
