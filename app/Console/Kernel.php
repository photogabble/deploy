<?php

namespace App\Console;

use App\Console\Commands\UserManagement\UserAdd;
use App\Console\Commands\UserManagement\UserDelete;
use App\Console\Commands\UserManagement\UserList;
use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        UserAdd::class,
        UserDelete::class,
        UserList::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //
    }
}
