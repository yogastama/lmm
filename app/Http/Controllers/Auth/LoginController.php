<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\LmdUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class LoginController extends Controller
{
    public function index(){
        if(!$this->checkHasLmdUserTable()){
            return redirect()->to('/install')->with([
                'alert-type' => 'warning',
                'message' => 'Lets install app!'
            ]);
        }
        return view('auth.login');
    }
    public function process_login(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $lmdUser = LmdUser::where('username', $request->post('username'))->first();
        if(!$lmdUser){
            return redirect()->to('/login')->with([
                'alert-type' => 'danger',
                'message' => 'Wrong username or Password!'
            ]);
        }
        if(Hash::check($request->post('password'), $lmdUser->password)){
            $request->session()->put('lmd-login', true);
            $request->session()->put('username', $lmdUser->username);
            $request->session()->put('id', $lmdUser->id);
            return redirect()->to('/home');
        }else{
            return redirect()->to('/login')->with([
                'alert-type' => 'danger',
                'message' => 'Wrong username or Password!'
            ]);
        }
    }
}
