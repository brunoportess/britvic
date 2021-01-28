<?php

namespace App\Console;

use App\Jobs\NotificaEmailReserva;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        // AGENDAMENTO DO JOB QUE ENVIARIA UM EMAIL NOTIFICANDO
        // AS RESERVAS FEITAS NA PARTE DA MANHA (12HS) E OUTRO DO DIA INTEIRO (23HS)
        $schedule->call(NotificaEmailReserva::dispatch())->twiceDaily(12, 23);
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
