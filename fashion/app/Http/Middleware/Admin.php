<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // return $next($request);
        // return auth()->user()->roles;
        if (Auth::check()) {
            $user = auth()->user()->roles;// Auth::user();
            if(auth()->user()->roles->where('slug', 'ADMIN')->first()){
                return $next($request);
            }
            // if ($user->roles()->slug == 'ADMIN') {
            // }
        }

        session()->put('noty', [
            'title' => '',
            'message' => 'شما اجازه دسترسی به این بخش را ندارید1.',
            'status' => 'info',
            'data' => '',
        ]);
        return redirect()->route('admin');
    }
}
