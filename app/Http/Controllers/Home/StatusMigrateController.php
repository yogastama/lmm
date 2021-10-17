<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Library\GetListMigration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class StatusMigrateController extends Controller
{
    public function __construct()
    {
        $this->migrator = app('migrator');
    }
    public function index(){
        $statusMigrate = new GetListMigration();
        $migrationFiles = $statusMigrate->handle();
        $data = [
            'migrationFiles' => $migrationFiles,
            'menu' => 'status_migrate'
        ];
        return view('home.status_migrate.status_migrate', $data);
    }
    public function show_file($file_name){
        $migrationPaths = array_merge(
            $this->migrator->paths(), [base_path('database' . DIRECTORY_SEPARATOR . 'migrations')]
        );
        $isFileExists = false;
        $filePath = false;
        foreach ($migrationPaths as $key => $value) {
            $findFileExists = file_exists($value . DIRECTORY_SEPARATOR . $file_name  . '.php');
            if($findFileExists){
                $filePath = $value . DIRECTORY_SEPARATOR . $file_name . '.php';
                break;
            }
        }
        if(!$filePath){
            return redirect()->back()->with([
                'alert-type' => 'danger',
                'message' => 'File not found'
            ]);
        }
        $data = [
            'menu' => 'status_migrate',
            'file_name' => $file_name,
            'file_content' => file_get_contents($filePath)
        ];
        // dd($data['file_content']);
        return view('home.status_migrate.show_migration', $data);
    }
}
