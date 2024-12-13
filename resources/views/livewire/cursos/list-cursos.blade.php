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
                <th class="border border-gray-300 p-2 text-md" style="width: 15%;">Días</th>
                <th class="border border-gray-300 p-2 text-md" style="width: 20%;">Horario</th>
                <th class="border border-gray-300 p-2 text-md">Profesor</th>
                <th class="border border-gray-300 p-2 text-md">Fecha Inicio</th>
                <th class="border border-gray-300 p-2 text-md">Fecha Fin</th>
                <th class="border border-gray-300 p-2 text-md" style="width: 10%;">Descripción</th>
                <th class="border border-gray-300 p-2 text-md">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cursos as $curso)
                <tr wire:key="{{$curso->id}}" class="bg-white border-b hover:bg-gray-50">
                    <td class="border border-gray-300 p-2 text-md text-black">{{ $curso->id }}</td>
                    <td class="border border-gray-300 p-2 text-md text-black">{{ $curso->nombre }}</td>
                    <td class="border border-gray-300 p-2 text-md text-black">
                        @foreach($curso->horariosCurso as $horario)
                            <div>{{ ucfirst($horario->dia_semana) }}</div>
                        @endforeach
                    </td>
                    <td class="border border-gray-300 p-2 text-md text-black">
                        @foreach($curso->horariosCurso as $horario)
                            <div>{{ \Carbon\Carbon::parse($horario->hora_inicio)->format('H:i') }} - {{ \Carbon\Carbon::parse($horario->hora_fin)->format('H:i') }}</div>
                        @endforeach
                    </td>
                    <td class="border border-gray-300 p-2 text-md text-black">{{ $curso->usuario->name }}</td>
                    <td class="border border-gray-300 p-2 text-md text-black">{{ $curso->fecha_inicio->format("d-m-Y")}}</td>
                    <td class="border border-gray-300 p-2 text-md text-black">{{ $curso->fecha_fin->format("d-m-Y") }}</td>
                    <td class="border border-gray-300 p-2 text-md text-black">{{ $curso->descripcion }}</td>
                    <td class="border border-gray-300 p-2 text-center">
                        <div class="flex justify-center items-center gap-4">
                            <!-- Editar -->
                            <a href="{{ route('cursos-cursos-edit', $curso->id) }}" class="text-blue-600 hover:text-blue-900 relative group">
                                <i class="fas fa-edit"></i>
                                <span class="absolute bottom-full mb-2 hidden text-sm text-white bg-black rounded px-2 py-1 group-hover:block">Editar Curso</span>
                            </a>
                            <!-- Matricular -->
                            <a href="{{ route('cursos-cursos-matriculacion', $curso->id) }}" class="text-green-600 hover:text-green-900 relative group">
                                <i class="fas fa-user-plus"></i>
                                <span class="absolute bottom-full mb-2 hidden text-sm text-white bg-black rounded px-2 py-1 group-hover:block">Matricular en Curso</span>
                            </a>
                            <!-- Ver Alumnos -->
                            <a href="{{route('cursos-cursos-alumnos', $curso->id)}}" class="text-indigo-600 hover:text-indigo-900 relative group">
                                <i class="fas fa-users"></i>
                                <span class="absolute bottom-full mb-2 hidden text-sm text-white bg-black rounded px-2 py-1 group-hover:block">Ver Alumnos</span>
                            </a>
                            <!-- Dar de baja -->
                            <button wire:click="deleteCurso({{ $curso->id }})" wire:confirm="¿Desea dar de baja este Curso?" class="text-red-600 hover:text-red-900 relative group">
                                <i class="fas fa-trash-alt"></i>
                                <span class="absolute bottom-full mb-2 hidden text-sm text-white bg-black rounded px-2 py-1 group-hover:block">Dar de Baja</span>
                            </button>
                            <!-- Ver Clases -->
                            <a href="{{ route('clases-clases-index', ['cursoId' => $curso->id]) }}" class="text-indigo-600 hover:text-indigo-900 relative group">
                                <i class="fas fa-chalkboard-teacher"></i>
                                <span class="absolute bottom-full mb-2 hidden text-sm text-white bg-black rounded px-2 py-1 group-hover:block">Ver Clases</span>
                            </a>
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

