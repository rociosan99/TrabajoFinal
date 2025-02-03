<div class="container mx-auto p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-3xl font-semibold text-gray-800">Estadísticas de Asistencia</h1>

    <div class="mb-4">
        <label for="curso" class="block text-gray-700">Selecciona un Curso:</label>
        <select id="curso" wire:model="cursoSeleccionado" onchange="cambiarCurso()"
            class="form-select mt-2 block w-full">
            <option value="">Todos los cursos</option>
            @foreach ($cursos as $curso)
                <option value="{{ $curso->id }}">{{ $curso->nombre }}</option>
            @endforeach
        </select>
    </div>


    <!-- Gráfico de Asistencias por Día -->
    <div class="mt-6">
        <h2 class="text-xl font-semibold text-gray-700">Asistencias por Día</h2>
        <canvas id="asistenciasPorDia"></canvas>
    </div>

    <!-- Histograma de Asistencias por Clase -->
    <div class="mt-6">
        <h2 class="text-xl font-semibold text-gray-700">Histograma de Asistencias por Clase</h2>
        <canvas id="asistenciasPorClase"></canvas>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- Script para generar gráficos con Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    let graficoslineas;
    $(document).ready(function() {
        // Datos de asistencia por día
        const asistenciasPorDia = @json($asistenciasPorDia);
        const dias = asistenciasPorDia.map(d => d.fecha);
        const asistencias = asistenciasPorDia.map(d => d.cantidad);

        const ctx1 = document.getElementById("asistenciasPorDia").getContext("2d");
        graficoslineas = new Chart(ctx1, {
            type: "line",
            data: {
                labels: dias,
                datasets: [{
                    label: "Asistencias",
                    data: asistencias,
                    borderColor: "blue",
                    backgroundColor: "rgba(54, 162, 235, 0.2)",
                    borderWidth: 2
                }]
            }
        });


        // Datos del histograma de asistencias por clase
        const asistenciasPorClase = @json($asistenciasPorClase);
        const clases = asistenciasPorClase.map(c => c.fecha_clase);
        const cantidades = asistenciasPorClase.map(c => c.cantidad_asistencias);

        const ctx2 = document.getElementById("asistenciasPorClase").getContext("2d");
        new Chart(ctx2, {
            type: "bar",
            data: {
                labels: clases,
                datasets: [{
                    label: "Asistencias por Clase",
                    data: cantidades,
                    backgroundColor: "green",
                    borderColor: "darkgreen",
                    borderWidth: 1
                }]
            }

        });
    });

    function ajax_chart(chart, url, data) {
            var data = data || {};
            $.getJSON(url, data).done(function(response) {
                console.log("Pude tener una respuesta:")
                console.log("response", response);
                const etiquetas = response.map(unaClase => unaClase.fecha);
                const cantidades = response.map(unaClase => unaClase.cantidad);
                chart.data.labels = etiquetas;
                chart.data.datasets[0].data = cantidades
                chart.update(); // finally update our chart
            });
        }

    function cambiarCurso(e) {
        let idCurso = $('#curso').val();
        data = {'id': idCurso}
        ajax_chart(graficoslineas, 'http://127.0.0.1:8000/estadistica/estadistica/api', data)
    }
</script>
