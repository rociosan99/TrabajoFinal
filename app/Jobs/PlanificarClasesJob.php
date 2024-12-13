<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Curso;
use App\Models\Clase; // Modelo para guardar las clases generadas
use Carbon\Carbon;

class PlanificarClasesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $curso;
    protected $dias;

    /**
     * Create a new job instance.
     *
     * @param Curso $curso
     * @param array $dias Días de la semana (e.g., ['lunes', 'miércoles'])
     */
    public function __construct(Curso $curso, array $dias)
    {
        $this->curso = $curso;
        $this->dias = $dias;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $fechaInicio = Carbon::parse($this->curso->fecha_inicio);
        $fechaFin = Carbon::parse($this->curso->fecha_fin);

        $planDeClases = [];
        $currentDate = $fechaInicio;

        while ($currentDate <= $fechaFin) {
            foreach ($this->dias as $dia) {
                if ($currentDate->englishDayOfWeek == $this->translateDayToCarbon($dia['dia'])) {
                    $planDeClases[] = [
                        'fecha_clase' => $currentDate->format('Y-m-d'),
                        'hora_inicio' => $dia['hora_inicio'],
                        'hora_fin' => $dia['hora_fin'],
                        'curso_id' => $this->curso->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
            $currentDate->addDay();
        }

        // Insertar las clases generadas
        Clase::insert($planDeClases);
    }

    /**
     * Translate day name to Carbon day index.
     *
     * @param string $dayName
     * @return int
     */
    protected function translateDayToCarbon($dayName)
    {
        $days = [
            'lunes' => Carbon::MONDAY,
            'martes' => Carbon::TUESDAY,
            'miércoles' => Carbon::WEDNESDAY,
            'jueves' => Carbon::THURSDAY,
            'viernes' => Carbon::FRIDAY,
            'sábado' => Carbon::SATURDAY,
            'domingo' => Carbon::SUNDAY,
        ];

        return $days[strtolower($dayName)] ?? null;
    }
}