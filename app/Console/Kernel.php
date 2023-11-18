<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Modules\Complaint\Entities\Complaint;
use Spatie\Backup\Tasks\Backup\BackupJob;
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
        $schedule->call(function () {
            $invalidComplaints = Complaint::whereNotNull('referenced_at')->whereNull('answered_at')->where('referenced_at', "<=", Carbon::now()->subDays((int) complaintConfig('deadline-responding')))->get();

            foreach ($invalidComplaints as $complaint) {
                $complaint->forceFill([
                    'is_invalid' => 1
                ]);

                $complaint->save();

                $complaint->userFails()->create([
                    'user_id' => $complaint->reference_id,
                    'departement_id' => $complaint->departement_id
                ]);
            }
        })->everySixHours();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }

    public function backupRun()
    {
        $backupJob = new BackupJob();

        $backupJob->run();
    }
}