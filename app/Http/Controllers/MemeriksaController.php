<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Periksa;
use App\Models\DetailPeriksa;
use Illuminate\Http\Request;

class MemeriksaController extends Controller
{
    public function dashboard()
    {
        // Mengambil semua data pemeriksaan beserta pasien yang terkait
        $periksa = Periksa::with('pasien')->get();

        // Mengirim data ke view
        return view('dokter.memeriksa.index', compact('periksa'));
    }

    public function memeriksa($id)
    {
        // Mengambil data pemeriksaan berdasarkan ID
        $periksa = Periksa::find($id);
        // Mengambil semua data obat dari tabel 'obat'
        $obat = Obat::all();
        // Mengambil detail pemeriksaan untuk obat yang dipilih
        $detail_periksa = DetailPeriksa::where('id_periksa', $id)->first();

        // Menyimpan obat yang dipilih sebelumnya
        $selected_obats = [];
        if ($detail_periksa) {
            $selected_obats = DetailPeriksa::where('id_periksa', $id)
                ->pluck('id_obat')
                ->toArray();
        }

        // Mengirimkan data ke view
        return view('dokter.memeriksa.memeriksa', compact('periksa', 'obat', 'detail_periksa', 'selected_obats'));
    }

    public function edit($id)
    {
        // Mengambil data pemeriksaan dan detail periksa
        $periksa = Periksa::find($id);
        // Mengambil semua data obat dari tabel 'obat'
        $obat = Obat::all();
        // Mengambil detail periksa terkait
        $detail_periksa = DetailPeriksa::where('id_periksa', $id)->first();

        // Menyusun daftar obat yang sudah dipilih
        $selected_obats = [];
        if ($detail_periksa) {
            $selected_obats = DetailPeriksa::where('id_periksa', $id)
                ->pluck('id_obat')
                ->toArray();
        }

        // Mengirimkan data ke view
        return view('dokter.memeriksa.edit', compact('periksa', 'obat', 'detail_periksa', 'selected_obats'));
    }

    public function store(Request $req)
    {
        // Validasi input dari form
        $req->validate([
            'tgl_periksa' => 'required|date',
            'catatan' => 'required|string',
            'biaya_periksa' => 'required|numeric',
            'obat' => 'nullable|array',
            'obat.*' => 'exists:obat,id'  // Menyesuaikan dengan nama tabel 'obat'
        ]);

        // Update data pemeriksaan
        $periksa = Periksa::find($req->id_periksa ?? $req->route('id'));
        $periksa->update([
            'tgl_periksa' => $req->tgl_periksa,
            'catatan' => $req->catatan,
            'biaya_periksa' => $req->biaya_periksa
        ]);

        // Hapus semua detail pemeriksaan yang ada untuk periksa ini
        DetailPeriksa::where('id_periksa', $periksa->id)->delete();

        // Tambahkan detail pemeriksaan baru jika ada obat yang dipilih
        if ($req->has('obat') && !empty($req->obat)) {
            foreach ($req->obat as $id_obat) {
                DetailPeriksa::create([
                    'id_periksa' => $periksa->id,
                    'id_obat' => $id_obat
                ]);
            }
        }

        // Redirect ke halaman pemeriksaan dengan pesan sukses
        return redirect('dokter/memeriksa')->with('success', 'Data pemeriksaan berhasil disimpan');
    }

    public function update(Request $req)
    {
        // Validasi input
        $req->validate([
            'tgl_periksa' => 'required|date',
            'catatan' => 'required|string',
            'biaya_periksa' => 'required|numeric',
            'obat' => 'nullable|array',
            'obat.*' => 'exists:obat,id'
        ]);

        // Update data pemeriksaan
        $periksa = Periksa::find($req->id_periksa ?? $req->route('id'));
        $periksa->update([
            'tgl_periksa' => $req->tgl_periksa,
            'catatan' => $req->catatan,
            'biaya_periksa' => $req->biaya_periksa
        ]);

        // Hapus semua detail pemeriksaan yang ada untuk periksa ini
        DetailPeriksa::where('id_periksa', $periksa->id)->delete();

        // Tambahkan detail pemeriksaan baru jika ada obat yang dipilih
        if ($req->has('obat') && !empty($req->obat)) {
            foreach ($req->obat as $id_obat) {
                DetailPeriksa::create([
                    'id_periksa' => $periksa->id,
                    'id_obat' => $id_obat
                ]);
            }
        }

        // Redirect ke halaman pemeriksaan dengan pesan sukses
        return redirect('dokter/memeriksa')->with('success', 'Data pemeriksaan berhasil disimpan');
    }
}
