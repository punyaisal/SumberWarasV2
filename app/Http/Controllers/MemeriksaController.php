<?php
namespace App\Http\Controllers;
use App\Models\DetailPeriksa;
use App\Models\Obat;
use App\Models\Periksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MemeriksaController extends Controller
{
    public function dashboard()
    {
        // Eager load pasien untuk memastikan relasi terhubung dengan benar
        $memeriksas = Periksa::with('pasien')->get();
        
        // Debugging - uncomment jika perlu melihat struktur data
        // dd($memeriksas);
        
        return view('dokter.memeriksa.index', compact('memeriksas'));
    }
    
    public function memeriksa($id)
    {
        $periksa = Periksa::with('pasien')->find($id);
        
        if (!$periksa) {
            return redirect()->back()->with('error', 'Data pemeriksaan tidak ditemukan');
        }
        
        $obats = Obat::all();
        $detail_periksa = DetailPeriksa::where('id_periksa', $id)->first();
        $selected_obats = [];
        
        if ($detail_periksa) {
            $selected_obats = DetailPeriksa::where('id_periksa', $id)
                ->pluck('id_obat')
                ->toArray();
        }
        
        return view('dokter.memeriksa.memeriksa', compact('detail_periksa', 'periksa', 'obats', 'selected_obats'));
    }
    
    public function edit($id)
    {
        $periksa = Periksa::with('pasien')->find($id);
        
        if (!$periksa) {
            return redirect()->back()->with('error', 'Data pemeriksaan tidak ditemukan');
        }
        
        $obats = Obat::all();
        $detail_periksa = DetailPeriksa::where('id_periksa', $id)->first();
        $selected_obats = [];
        
        if ($detail_periksa) {
            $selected_obats = DetailPeriksa::where('id_periksa', $id)
                ->pluck('id_obat')
                ->toArray();
        }
        
        return view('dokter.memeriksa.edit', compact('detail_periksa', 'periksa', 'obats', 'selected_obats'));
    }
    
    public function store(Request $req)
    {
        // Validasi input
        $req->validate([
            'tgl_periksa' => 'required|date',
            'catatan' => 'required|string',
            'biaya_periksa' => 'required|numeric',
            'obat' => 'nullable|array',
            'obat.*' => 'exists:obat,id'
        ]);
        
        // Log data untuk debugging
        Log::info('Menyimpan pemeriksaan dengan data:', $req->all());
        Log::info('Obat array:', $req->obat ?? []);
        
        // Temukan model periksa
        $periksa = Periksa::find($req->id_periksa ?? $req->route('id'));
        
        if (!$periksa) {
            return redirect()->back()->with('error', 'Data pemeriksaan tidak ditemukan');
        }
        
        // Gunakan transaksi database untuk memastikan konsistensi
        try {
            DB::beginTransaction();
            
            // Update data periksa
            $periksa->update([
                'tgl_periksa' => $req->tgl_periksa,
                'catatan' => $req->catatan,
                'biaya_periksa' => $req->biaya_periksa
            ]);
            
            // Hapus semua detail periksa yang ada untuk periksa ini
            DetailPeriksa::where('id_periksa', $periksa->id)->delete();
            
            // Tambahkan detail periksa baru jika ada obat yang dipilih
            if ($req->has('obat') && !empty($req->obat)) {
                foreach ($req->obat as $id_obat) {
                    DetailPeriksa::create([
                        'id_periksa' => $periksa->id,
                        'id_obat' => (int)$id_obat // Pastikan ID adalah integer
                    ]);
                }
            }
            
            DB::commit();
            return redirect('dokter/memeriksa')->with('success', 'Data pemeriksaan berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error menyimpan pemeriksaan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    public function update(Request $req, $id = null)
    {
        // Validasi input
        $req->validate([
            'tgl_periksa' => 'required|date',
            'catatan' => 'required|string',
            'biaya_periksa' => 'required|numeric',
            'obat' => 'nullable|array',
            'obat.*' => 'exists:obat,id'
        ]);
        
        // Log data untuk debugging
        Log::info('Update pemeriksaan dengan data:', $req->all());
        Log::info('Obat array:', $req->obat ?? []);
        
        // Temukan model periksa
        $periksa = Periksa::find($req->id_periksa ?? $id);
        
        if (!$periksa) {
            return redirect()->back()->with('error', 'Data pemeriksaan tidak ditemukan');
        }
        
        // Gunakan transaksi database untuk memastikan konsistensi
        try {
            DB::beginTransaction();
            
            // Update data periksa
            $periksa->update([
                'tgl_periksa' => $req->tgl_periksa,
                'catatan' => $req->catatan,
                'biaya_periksa' => $req->biaya_periksa
            ]);
            
            // Hapus semua detail periksa yang ada untuk periksa ini
            DetailPeriksa::where('id_periksa', $periksa->id)->delete();
            
            // Tambahkan detail periksa baru jika ada obat yang dipilih
            if ($req->has('obat') && !empty($req->obat)) {
                foreach ($req->obat as $id_obat) {
                    DetailPeriksa::create([
                        'id_periksa' => $periksa->id,
                        'id_obat' => (int)$id_obat // Pastikan ID adalah integer
                    ]);
                }
            }
            
            DB::commit();
            return redirect('dokter/memeriksa')->with('success', 'Data pemeriksaan berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error update pemeriksaan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}