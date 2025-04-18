@extends('layouts.app')

@section('title', 'kesehatan | Memeriksa')

@section('nav-item')
    <li class="nav-item">
        <a href="/dokter/memeriksa" class="nav-link">
            <i class="nav-icon fas fa-sharp-duotone fa-solid fa-stethoscope"></i>
            <p>Memeriksa</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="/dokter/obat" class="nav-link">
            <i class="nav-icon fas fa-solid fa-pills"></i>
            <p>Obat</p>
        </a>
    </li>
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pemeriksaan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dokter/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="/dokter/memeriksa">Memeriksa</a></li>
                        <li class="breadcrumb-item active">Pemeriksaan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form Pemeriksaan</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="/dokter/memeriksa/{{ $periksa->id }}" id="form-pemeriksaan">
                            @csrf
                            @method('PUT')
                            <!-- Tambahkan input hidden untuk menyimpan id_periksa -->
                            <input type="hidden" name="id_periksa" value="{{ $periksa->id }}">

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama_pasien">Nama Pasien</label>
                                    <input type="text" class="form-control" id="nama_pasien" name="nama"
                                        value="{{ $periksa->pasien->name ?? $periksa->pasien->nama ?? 'Nama tidak tersedia' }}" placeholder="Masukkan Nama" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="tgl">Tanggal</label>
                                    <input type="date" class="form-control" id="tgl" name="tgl_periksa"
                                        placeholder="Masukkan Tanggal" value="{{ $periksa->tgl_periksa }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="catatan">Catatan</label>
                                    <input type="text" class="form-control" id="catatan" name="catatan"
                                        placeholder="Berikan Catatan" value="{{ $periksa->catatan }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Obat</label>
                                    <div class="d-flex">
                                        <select class="custom-select form-control" id="obat-select">
                                            <option selected value="">Pilih Obat</option>
                                            @foreach($obats as $obat)
                                                <option value="{{ $obat->id }}" data-harga="{{ $obat->harga }}">
                                                    {{ $obat->nama_obat }} - {{ $obat->kemasan }} -
                                                    Rp {{ number_format($obat->harga, 0, ',', '.') }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button type="button" id="tambah-obat" class="btn btn-outline-primary ml-2">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                        <button type="button" id="clear-all-obats" class="btn btn-outline-danger ml-2">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>

                                    <div class="selected-obats mt-3" id="selected-obats-container">
                                        <ul class="list-group" id="selected-obats-list">
                                            @if(isset($selected_obats) && !empty($selected_obats))
                                                @foreach($obats as $obat)
                                                    @if(in_array($obat->id, $selected_obats))
                                                        <li class="list-group-item d-flex justify-content-between align-items-center"
                                                            data-id="{{ $obat->id }}" data-harga="{{ $obat->harga }}">
                                                            <span>{{ $obat->nama_obat }} - {{ $obat->kemasan }} - Rp
                                                            {{ number_format($obat->harga, 0, ',', '.') }}</span>
                                                            <button type="button" class="btn btn-sm btn-danger remove-obat">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                            <input type="hidden" name="obat[]" value="{{ $obat->id }}">
                                                        </li>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="biaya">Biaya Periksa dan Obat</label>
                                    <input type="number" class="form-control" id="biaya" name="biaya_periksa"
                                        placeholder="Masukkan Biaya Periksa" value="150000" readonly>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log("Dokumen siap");
        
        // Elemen-elemen utama
        const obatSelect = document.getElementById('obat-select');
        const tambahObatBtn = document.getElementById('tambah-obat');
        const selectedObatsList = document.getElementById('selected-obats-list');
        const selectedObatsContainer = document.getElementById('selected-obats-container');
        const clearAllBtn = document.getElementById('clear-all-obats');
        const biayaInput = document.getElementById('biaya');
        const formPemeriksaan = document.getElementById('form-pemeriksaan');
        
        // Default biaya dan set obat yang dipilih
        const defaultBiaya = 150000;
        const selectedObats = new Set();
        
        // Fungsi untuk menghitung total biaya
        function calculateTotalBiaya() {
            let total = defaultBiaya;
            document.querySelectorAll('#selected-obats-list li').forEach(function(item) {
                const obatHarga = parseInt(item.getAttribute('data-harga') || 0);
                total += obatHarga;
            });
            biayaInput.value = total;
            console.log("Total dihitung:", total);
            return total;
        }
        
        // Fungsi untuk menambahkan obat ke daftar
        function addObatToList(obatId, obatText, obatHarga) {
            if (obatId && !selectedObats.has(obatId)) {
                console.log("Menambahkan obat:", obatId, obatText, obatHarga);
                
                // Buat li element baru
                const li = document.createElement('li');
                li.className = 'list-group-item d-flex justify-content-between align-items-center';
                li.setAttribute('data-id', obatId);
                li.setAttribute('data-harga', obatHarga);
                
                // Buat span untuk teks
                const textSpan = document.createElement('span');
                textSpan.textContent = obatText;
                
                // Buat tombol hapus
                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.className = 'btn btn-sm btn-danger remove-obat';
                removeBtn.innerHTML = '<i class="fas fa-times"></i>';
                
                // Buat input hidden
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'obat[]';
                hiddenInput.value = obatId;
                
                // Gabungkan semua elemen
                li.appendChild(textSpan);
                li.appendChild(removeBtn);
                li.appendChild(hiddenInput);
                selectedObatsList.appendChild(li);
                
                selectedObats.add(obatId);
                selectedObatsContainer.style.display = 'block';
                calculateTotalBiaya();
                
                return true;
            } else if (selectedObats.has(obatId)) {
                console.log("Obat sudah dipilih:", obatId);
            }
            
            return false;
        }
        
        // Fungsi untuk menghapus obat dari daftar
        function removeObatFromList(li) {
            if (li) {
                const obatId = li.getAttribute('data-id');
                li.remove();
                selectedObats.delete(obatId);
                console.log("Obat dihapus:", obatId);
                
                if (selectedObatsList.querySelectorAll('li').length === 0) {
                    selectedObatsContainer.style.display = 'none';
                }
                
                calculateTotalBiaya();
                return true;
            }
            
            return false;
        }
        
        // Inisialisasi UI
        function initializeUI() {
            // Tampilkan/sembunyikan container berdasarkan konten
            if (selectedObatsList.querySelectorAll('li').length === 0) {
                selectedObatsContainer.style.display = 'none';
            } else {
                selectedObatsContainer.style.display = 'block';
                calculateTotalBiaya();
            }
            
            // Inisialisasi Set dengan ID obat yang ada
            document.querySelectorAll('#selected-obats-list li').forEach(function(item) {
                const obatId = item.getAttribute('data-id');
                if (obatId) {
                    selectedObats.add(obatId.toString());
                    console.log("Menambahkan obat yang ada ke Set:", obatId);
                }
            });
            
            console.log("UI diinisialisasi");
        }
        
        // Inisialisasi UI saat halaman dimuat
        initializeUI();
        
        // Tambahkan obat saat tombol tambah diklik
        if (tambahObatBtn) {
            tambahObatBtn.addEventListener('click', function(e) {
                e.preventDefault();
                
                const selectedOption = obatSelect.options[obatSelect.selectedIndex];
                const obatId = selectedOption.value;
                const obatText = selectedOption.textContent;
                const obatHarga = selectedOption.getAttribute('data-harga');
                
                console.log("Dipilih:", obatId, obatText, obatHarga);
                
                if (obatId && obatId !== '' && obatId !== 'Pilih Obat') {
                    addObatToList(obatId, obatText, obatHarga);
                    obatSelect.selectedIndex = 0;
                }
            });
        }
        
        // Tambahkan obat saat dropdown berubah
        if (obatSelect) {
            obatSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const obatId = selectedOption.value;
                const obatText = selectedOption.textContent;
                const obatHarga = selectedOption.getAttribute('data-harga');
                
                console.log("Dipilih dari dropdown:", obatId, obatText, obatHarga);
                
                if (obatId && obatId !== '' && obatId !== 'Pilih Obat') {
                    if (addObatToList(obatId, obatText, obatHarga)) {
                        // Reset dropdown setelah berhasil menambahkan
                        this.selectedIndex = 0;
                    }
                }
            });
        }
        
        // Hapus semua obat
        if (clearAllBtn) {
            clearAllBtn.addEventListener('click', function(e) {
                e.preventDefault();
                console.log("Menghapus semua obat");
                
                // Hapus semua li dari daftar
                while (selectedObatsList.firstChild) {
                    selectedObatsList.removeChild(selectedObatsList.firstChild);
                }
                
                selectedObats.clear();
                selectedObatsContainer.style.display = 'none';
                biayaInput.value = defaultBiaya;
            });
        }
        
        // Tambahkan event listener pada tombol hapus yang sudah ada
        document.querySelectorAll('.remove-obat').forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                console.log('Tombol hapus diklik!');
                
                // Hapus item dari daftar
                removeObatFromList(this.closest('li'));
            });
        });
        
        // Tambahkan event delegation untuk tombol hapus
        document.addEventListener('click', function(event) {
            const target = event.target;
            
            // Cek apakah yang diklik adalah tombol hapus atau ikon di dalamnya
            if (target.classList.contains('remove-obat') || target.closest('.remove-obat')) {
                event.preventDefault();
                event.stopPropagation();
                console.log('Tombol hapus diklik (delegasi event)!');
                
                // Hapus item dari daftar
                removeObatFromList(target.closest('li'));
            }
        });
        
        // Validasi form sebelum submit
        if (formPemeriksaan) {
            formPemeriksaan.addEventListener('submit', function(e) {
                // Cek apakah ada obat yang dipilih (opsional, sesuai kebutuhan)
                // Jika ingin memastikan ada obat yang dipilih:
                // if (selectedObatsList.querySelectorAll('li').length === 0) {
                //     e.preventDefault();
                //     alert('Pilih minimal satu obat!');
                //     return false;
                // }
                
                console.log('Form disubmit dengan', selectedObatsList.querySelectorAll('li').length, 'obat');
                return true;
            });
        }
    });
    </script>
@endsection