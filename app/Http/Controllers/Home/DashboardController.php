<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Library\GetListMigration;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function home(){
        $statusMigrate = new GetListMigration();
        $migrationFiles = $statusMigrate->handle();
        $data = [
            'menu' => 'home',
            'migrationFiles'=> $migrationFiles
        ];
        return view('home.home', $data);
    }
    public function logout(Request $request){
        $request->session()->flush();
        return redirect()->to('/login');
    }
}
