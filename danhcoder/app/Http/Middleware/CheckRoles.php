<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;

class CheckRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role1 = 0, $role2 = 0, $role3 = 0, $role4 = 0)
    {
        if (Auth::user()->positions_id == $role1 || Auth::user()->positions_id == $role2 || Auth::user()->positions_id == $role3 || Auth::user()->positions_id == $role4) {
            return $next($request);
        }
        $request->session()->flash('sessionStatusRoles', "Bạn không đủ quyền vào mục này!");
        return redirect()->route('dashboard');
    }
}
