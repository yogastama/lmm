<?php

namespace App\Http\Controllers;

use App\Models\LmdUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class InstallController extends Controller
{
    public function install(){
        $hasLmdUserTable = $this->checkHasLmdUserTable();
        if($hasLmdUserTable){
            return redirect()->to('/login')->with([
                'alert-type' => 'info',
                'message' => 'LMD already installed!'
            ]);
        }
        $data = [
            'has_lmd_user_table' => $hasLmdUserTable
        ];
        return view('install.install', $data);
    }
    public function install_process(Request $request){
        $hasLmdUserTable = $this->checkHasLmdUserTable();
        if($hasLmdUserTable){
            return redirect()->to('/login')->with([
                'alert-type' => 'info',
                'message' => 'LMD already installed!'
            ]);
        }
        $request->validate([
            'username' => 'required|unique:users,username,"regex:/\s/"',
            'password' => 'required|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'required'
        ]);
        // run migration
        Artisan::call('migrate');
        // create users
        $newLmdUser = new LmdUser([
            'username' => $request->post('username'),
            'password' => bcrypt($request->post('password')),
        ]);
        $newLmdUser->save();
        // set session laravel login
        $request->session()->put('lmd-login', true);
        $request->session()->put('username', $newLmdUser->username);
        $request->session()->put('id', $newLmdUser->id);

        return redirect()->to('/home');
    }
}
