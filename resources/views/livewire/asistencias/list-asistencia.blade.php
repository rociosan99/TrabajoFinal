<div class="overflow-x-auto">
    <table class="min-w-full table-auto bg-white shadow-lg">
        <thead>
            <tr class="bg-gray-100 border-b">
                <th class="px-4 py-2 text-left">ID</th>
                <th class="px-4 py-2 text-left">Fecha de Clase</th>
                <th class="px-4 py-2 text-left">Alumno</th>
                <th class="px-4 py-2 text-left">Estado</th>
                <th class="px-4 py-2 text-left">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($asistencias as $asistencia)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $asistencia->id }}</td>
                    <td class="px-4 py-2">{{ $asistencia->fecha_clase->format('d-m-Y') }}</td>
                    <td class="px-4 py-2">{{ $asistencia->alumno->nombre }}</td>
                    <td class="px-4 py-2">
                        @if($asistencia->estado == 'presente')
                            <span class="text-green-500">Presente</span>
                        @elseif($asistencia->estado == 'ausente')
                            <span class="text-red-500">Ausente</span>
                        @else
                            <span class="text-yellow-500">Justificado</span>
                        @endif
                    </td>
                    <td class="px-4 py-2">
                        <button class="text-blue-500 hover:text-blue-700">Editar</button>
                        <button class="text-red-500 hover:text-red-700">Eliminar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
