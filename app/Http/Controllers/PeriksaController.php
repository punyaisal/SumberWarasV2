<?php
 
 namespace App\Http\Controllers;

 use App\Models\Periksa;
 use App\Models\User;
 use Illuminate\Http\Request;
 
 class PeriksaController extends Controller
 {
     // Menampilkan daftar pemeriksaan
     public function dashboard()
     {
         // Fetch only users with role='dokter'
         $dokters = User::where('role', 'dokter')->get();
 
         // Other data you need
         $periksas = Periksa::all();
 
         return view('pasien.periksa.index', compact('dokters', 'periksas'));
     }
 
     // Menampilkan form create
     public function create()
     {
         $pasiens = User::where('role', 'pasien')->latest()->get();
         $dokters = User::where('role', 'dokter')->latest()->get();
 
         return view('pasien.periksa.create', compact('dokters', 'pasiens'));
     }
 
     // Menyimpan data pemeriksaan pasien
     public function store(Request $req)
     {
         // Validasi input
         $req->validate([
             'id_pasien' => ['required', 'integer'],
             'id_dokter' => ['required', 'integer'],
         ]);
     
         // Menambahkan nilai default untuk biaya_periksa jika tidak disertakan dalam form
         $req->merge(['biaya_periksa' => $req->biaya_periksa ?? 0]);  // Jika biaya_periksa tidak ada, set jadi 0
     
         // Menambahkan tgl_periksa secara manual
         $req->merge(['tgl_periksa' => now()]);  // Menambahkan tanggal pemeriksaan secara otomatis
     
         // Membuat data pemeriksaan baru
         Periksa::create($req->all());
     
         // Redirect ke halaman pasien/periksa setelah data berhasil disimpan
         return redirect('pasien/periksa')->with('success', 'Berhasil Meminta Pemeriksaan');
     }
     

 }
 