<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected $commands = [
        Commands\FetchWeatherData::class,
    ];
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('fetch:weather')->everyTenMinutes();
        // $schedule->command('fetch:weather')->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */

    
    
}
