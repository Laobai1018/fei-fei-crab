<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureIdentified
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->is_admin) {
            return redirect()->route('admin.reservations.index');
        }
        if ($request->session()->has('customer_id') || $request->session()->get('guest')) {
            return $next($request);
        }
        return redirect()->route('login');
    }
}
