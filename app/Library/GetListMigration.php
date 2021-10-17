<?php

namespace App\Library;

use Illuminate\Database\Console\Migrations\BaseCommand;

class GetListMigration extends BaseCommand
{
    public function __construct()
    {
        parent::__construct();

        $this->migrator = app('migrator');
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $migrationPaths = array_merge(
            $this->migrator->paths(), [base_path('database' . DIRECTORY_SEPARATOR . 'migrations')]
        );
        $files = $this->migrator->getMigrationFiles($migrationPaths);
        $pendingMigrations = array_diff(
            array_keys($files),
            $this->getRanMigrations()
        );
        $filePendingMigrationsExists = [];
        foreach ($pendingMigrations as $kpm => $file_name) {
            foreach ($migrationPaths as $kppath => $path) {
                $findFileExists = file_exists($path . DIRECTORY_SEPARATOR . $file_name  . '.php');
                if($findFileExists){
                    $filePendingMigrationsExists[] = $file_name;
                    break;
                }
            }
        }
        $fileMigrationsExists = [];
        foreach ($this->getRanMigrations() as $kpm => $file_name) {
            foreach ($migrationPaths as $kppath => $path) {
                $findFileExists = file_exists($path . DIRECTORY_SEPARATOR . $file_name  . '.php');
                if($findFileExists){
                    $fileMigrationsExists[] = $file_name;
                    break;
                }
            }
        }
        return [
            'pending_migrations' => $pendingMigrations,
            'migrated' => $fileMigrationsExists
        ];
    }

    /**
     * Gets ran migrations with repository check
     * 
     * @return array
     */
    public function getRanMigrations()
    {
        if (! $this->migrator->repositoryExists()) {
            return [];
        }

        return $this->migrator->getRepository()->getRan(); 
    }
}