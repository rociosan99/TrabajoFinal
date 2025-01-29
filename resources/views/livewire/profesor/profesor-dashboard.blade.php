<div class="container mx-auto p-6 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 rounded-lg shadow-lg">
    <!-- Título de bienvenida -->
    <div class="text-center mb-6">
        <h1 class="text-4xl font-extrabold text-white">Hola, {{ Auth::user()->name }}!</h1>
        <p class="text-lg text-gray-200 mt-2">Aquí podrás ver las clases que debes impartir hoy.</p>
    </div>

    <!-- Lista de clases a impartir -->
    @if($clasesHoy->isEmpty())
        <p class="text-white text-center">No tienes clases programadas para hoy.</p>
    @else
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3">
            @foreach($clasesHoy as $clase)
                <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition duration-300">
                    <div class="flex items-center justify-between">
                        <h3 class="text-2xl font-semibold text-gray-800">{{ $clase->curso->nombre }}</h3>
                        <span class="text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($clase->hora_inicio)->format('h:i A') }} - 
                            {{ \Carbon\Carbon::parse($clase->hora_fin)->format('h:i A') }}
                        </span>
                    </div>
                    <p class="text-gray-600 mt-2">Duración: 
                        {{ \Carbon\Carbon::parse($clase->hora_inicio)->diffInMinutes($clase->hora_fin) / 60 }} horas
                    </p>
                    <td class="border border-gray-300 text-center py-4 px-4">
                        <!-- Botón de Asistencias -->
                        <a href="{{ route('asistencias-asistencias-create', $clase->id) }}" 
                           class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105">
                            Asistencias
                        </a>
                    </td>                    
                </div>
            @endforeach
        </div>
    @endif
</div>
