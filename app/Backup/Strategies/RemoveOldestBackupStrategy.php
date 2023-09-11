<?php

namespace App\Backup\Strategies;

use Spatie\Backup\Tasks\Cleanup\CleanupStrategy;
use Spatie\Backup\BackupDestination\BackupCollection;

class RemoveOldestBackupStrategy extends CleanupStrategy
{
    public function deleteOldBackups(BackupCollection $backupCollection)
    {
        $backup = $backupCollection->oldest();

        $backup->delete();
    }
}