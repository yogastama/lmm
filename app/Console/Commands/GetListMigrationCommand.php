<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Console\Migrations\BaseCommand;

class GetListMigrationCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:list {--database= : The database connection to use.}
    {--path= : The path of migrations files to be executed.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $migrator;

    /**
     * Create a command instance.
     *
     * @return void
     */
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
        // dd($this->option('database'));
        $this->migrator->setConnection($this->option('database'));

        $files = $this->migrator->getMigrationFiles($this->getMigrationPaths());
        $pendingMigrations = array_diff(
            array_keys($files),
            $this->getRanMigrations()
        );
        $response = [
            'pending_migrations' => $pendingMigrations,
            'migrated' => $this->getRanMigrations()
        ];
        dd($response);
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
