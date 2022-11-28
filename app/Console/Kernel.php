<?php

namespace App\Console;

use App\Jobs\FetchAndStoreProfile;
use App\Models\Profile;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function() {
            Log::debug("Fetch Profile Dispatched...");

            $profiles = Profile::all();

            foreach ($profiles as $profile) {
                FetchAndStoreProfile::dispatch($profile->p_uuid);
            }

        })->everyMinute();


        $schedule->call(function() {
            $result = DB::select(DB::raw('SELECT table_name AS "Table",
                ((data_length + index_length) / 1024 / 1024) AS "Size"
                FROM information_schema.TABLES
                WHERE table_schema ="'.'yesman'. '"
                ORDER BY (data_length + index_length) DESC'));
            $size = array_sum(array_column($result, 'Size'));
            $db_size = number_format((float)$size, 2, '.', '');
            Log::debug("DB SIZE: " . $db_size . "MB");

            $result2 = DB::select(DB::raw("SELECT SUM(TABLE_ROWS)
   FROM INFORMATION_SCHEMA.TABLES
   WHERE TABLE_SCHEMA = 'yesman';"));

            $test = "SUM(TABLE_ROWS)";
            Log::debug("STORED ROWS: " . $result2[0]->$test);

        })->everyMinute();

        // $schedule->command('inspire')->hourly();
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
