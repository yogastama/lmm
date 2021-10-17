<?php

namespace App\Http\Middleware;

use App\Models\LmdUser;
use Closure;
use Illuminate\Http\Request;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (session('lmd-login') && session('username') && session('id')) {
            $checkUserLmd = LmdUser::where('username', session('username'))->where('id', session('id'))->first();
            if(!$checkUserLmd){
                $request->session()->flush();
                return redirect()->to('/login')->with([
                    'alert-type' => 'error',
                    'message' => 'Session expired'
                ]);    
            }else{
                return $next($request);
            }
        } else {
            return redirect()->to('/login')->with([
                'alert-type' => 'error',
                'message' => 'Session expired'
            ]);
        }
        
    }
}
