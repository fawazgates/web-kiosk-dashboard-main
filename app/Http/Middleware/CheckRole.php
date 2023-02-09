<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;


class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $roles)
    {
        if (!session()->get('tokenlogin')) {
            return redirect('/');
        }
        $token = session()->get('tokenlogin');
        $credential = Http::withHeaders([
            'Authorization' => 'JWT ' . $token['access_token'],
        ])->get('https://gate.bisaai.id:8080/ekiosk_prod/check_credential');
        if ($credential->status() == 200) {
            $credential = json_decode($credential->body(), true)[0];
            $role = $credential['role'] == 1 ? 'superadmin' : ($credential['role'] == 2 ? 'admincanteen' : '');
            if ($role == $roles) {
                session()->put('role', $role);
                return $next($request);
            }
        }
        return redirect('/')->with('error', "Anda Tidak Punya Akses");
    }
}
