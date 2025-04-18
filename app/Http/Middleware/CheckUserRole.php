<?php
// app/Http/Middleware/CheckUserRole.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Cek apakah role user sesuai dengan yang diizinkan
        if (Auth::user()->role != $role) {
            // Redirect sesuai role user
            if (Auth::user()->role == 'pasien') {
                return redirect('/pasien/dashboard');
            } else if (Auth::user()->role == 'dokter') {
                return redirect('/dokter/dashboard');
            } else if (Auth::user()->role == 'admin') {
                return redirect('/admin/dashboard');
            }

            // Jika role tidak sesuai dan tidak dikenal, redirect ke login
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            return redirect('/login')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
        }

        return $next($request);
    }
}