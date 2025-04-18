<?php
// app/Http/Controllers/AuthController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Menangani login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Redirect berdasarkan role
            if (Auth::user()->role === 'dokter') {
                return redirect('/dokter/dashboard');
            } else if (Auth::user()->role === 'pasien') {
                return redirect('/pasien/dashboard');
            } else if (Auth::user()->role === 'admin') {
                return redirect('/admin/dashboard'); // Tambahkan jika ada dashboard admin
            }
            
            // Default redirect jika role tidak dikenali
            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    // Menangani logout
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login');
    }

    // Menampilkan form registrasi
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Menangani registrasi
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'max:50'],
            'alamat' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'string', 'max:50', 'unique:user'],
            'password' => ['required', 'min:8'],
        ]);

        // Membuat user baru dengan role default 'pasien'
        $user = User::create([
            'name' => $request->name,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pasien', // Set role default ke 'pasien'
        ]);
        
        // Login otomatis setelah registrasi
        Auth::login($user);

        // Redirect ke dashboard pasien setelah registrasi berhasil
        return redirect('/pasien/dashboard');
    }
}