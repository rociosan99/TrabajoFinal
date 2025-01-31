<div class="min-h-screen flex flex-col">
    <h2 class="text-lg font-bold mb-4">Comunicados Recibidos</h2>

    <div class="mb-4">
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-blue-500 hover:text-blue-700 font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Volver atrás
        </a>
    </div>

    <!-- Lista de comunicados -->
    <div class="flex-grow">
        <table class="w-full border-collapse border border-gray-300 bg-white">
            <thead>
                <tr class="bg-blue-500 text-white">
                    <th class="border border-gray-300 p-2 text-md">Receptor</th>
                    <th class="border border-gray-300 p-2 text-md">Título</th>
                    <th class="border border-gray-300 p-2 text-md">Fecha</th>
                    <th class="border border-gray-300 p-2 text-md">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($comunicados as $comunicado)
                <tr wire:key="{{ $comunicado->id }}">
                    <td class="border border-gray-300 p-2">{{ $comunicado->receptor->name }} {{ $comunicado->receptor->apellido }}</td>
                    <td class="border border-gray-300 p-2">{{ $comunicado->titulo }}</td>
                    <td class="border border-gray-300 p-2">{{ \Carbon\Carbon::parse($comunicado->fecha)->format('d-m-Y') }}</td>
                    <td class="border border-gray-300 p-2 text-center">
                        <div class="flex justify-center items-center gap-4">
                            <button wire:click="abrirModal({{ $comunicado->id_comunicacion }})" class="text-blue-600 hover:text-blue-900">Ver</button>
                            <button wire:click="deleteComunicado({{ $comunicado->id }})" wire:confirm="¿Desea borrar este comunicado?" class="text-red-600 hover:text-red-900">Eliminar</button>                            
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="border border-gray-300 p-2 text-center">
                        <span>Sin registros</span>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal para ver detalles de un comunicado -->
    @if ($modalAbierto)
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
            <div class="bg-white p-10 rounded-md shadow-xl w-full max-w-screen-lg overflow-auto">
                <h2 class="text-3xl font-bold mb-8">Detalle del Comunicado</h2>
                <!-- Mostrar el cuerpo del comunicado con el enlace -->
                <p class="text-lg mb-8">{!! nl2br($comunicadoSeleccionado->cuerpo) !!}</p>
                <div class="flex justify-end space-x-8">
                    <button wire:click="cerrarModal" class="bg-gray-500 text-white px-8 py-4 rounded-md hover:bg-gray-600 text-lg">Cerrar</button>
                </div>
            </div>
        </div>
    @endif
</div>
