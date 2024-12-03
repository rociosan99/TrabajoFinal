<div>
    <div class="w-full flex justify-end items-center gap-4 p-4">
        <a href="{{ route('cursos-cursos-create') }}" class="bg-green-700 hover:bg-green-800 text-white font-bold py-2 px-4 rounded transition-colors shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
            Agregar Curso
        </a>
    </div>
    <table class="w-full border-collapse border border-gray-300 bg-white">
        <thead>
            <tr class="bg-blue-500 text-white">
                <th class="border border-gray-300 p-2 text-md">ID</th>
                <th class="border border-gray-300 p-2 text-md">Nombre</th>
                <th class="border border-gray-300 p-2 text-md">Días</th>
                <th class="border border-gray-300 p-2 text-md">Horario</th>
                <th class="border border-gray-300 p-2 text-md">Profesor</th>
                <th class="border border-gray-300 p-2 text-md">Fecha Inicio</th>
                <th class="border border-gray-300 p-2 text-md">Fecha Fin</th>
                <th class="border border-gray-300 p-2 text-md">Descripción</th>
                <th class="border border-gray-300 p-2 text-md">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cursos as $curso)
                <tr wire:key="{{$curso->id}}" class="bg-white border-b hover:bg-gray-50">
                    <td class="border border-gray-300 p-2 text-md text-black">{{ $curso->id }}</td>
                    <td class="border border-gray-300 p-2 text-md text-black">{{ $curso->nombre }}</td>
                    <td class="border border-gray-300 p-2 text-md text-black">{{ $curso->dia }}</td>
                    <td class="border border-gray-300 p-2 text-md text-black">{{ $curso->horario }}</td>
                    <td class="border border-gray-300 p-2 text-md text-black">{{ $curso->usuario->name }}</td>
                    <td class="border border-gray-300 p-2 text-md text-black">{{ $curso->fecha_inicio->format("d-m-Y")}}</td>
                    <td class="border border-gray-300 p-2 text-md text-black">{{ $curso->fecha_fin->format("d-m-Y") }}</td>
                    <td class="border border-gray-300 p-2 text-md text-black">{{ $curso->descripcion }}</td>
                    <td class="border border-gray-300 p-2 text-center">
                        <div class="flex justify-center items-center gap-4">
                            <a href="{{ route('cursos-cursos-edit', $curso->id) }}" class="text-blue-600 hover:text-blue-900">Editar</a>
                            <a href="{{ route('cursos-cursos-matriculacion', $curso->id) }}" class="text-green-600 hover:text-green-900">Matricular</a>
                            <a href="" class="text-indigo-600 hover:text-indigo-900">Ver Alumnos</a>
                            <button wire:click="deleteCurso({{ $curso->id }})" wire:confirm="¿Desea dar de baja este Curso?" class="text-red-600 hover:text-red-900">Dar de baja</button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if ($editingCurso)
        <!-- Aquí permanece el código para editar cursos -->
    @endif
</div>
