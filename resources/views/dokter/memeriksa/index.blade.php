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
                        <form method="POST" action="/dokter/memeriksa">
                            @csrf
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
                                            <option selected>Pilih Obat</option>
                                            @foreach($obats as $obat)
                                                <option value="{{ $obat->id }}" data-harga="{{ $obat->harga }}">
                                                    {{ $obat->nama_obat }} - {{ $obat->kemasan }} -
                                                    Rp {{ number_format($obat->harga, 0, ',', '.') }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button type="button" id="clear-all-obats" class="btn btn-outline-danger ml-2"
                                            style="display: block;">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>

                                    <div class="selected-obats mt-3" id="selected-obats-container" style="display: block;">
                                        <ul class="list-group" id="selected-obats-list">
                                            @if(isset($selected_obats) && !empty($selected_obats))
                                                @foreach($obats as $obat)
                                                    @if(in_array($obat->id, $selected_obats))
                                                        <li class="list-group-item d-flex justify-content-between align-items-center"
                                                            data-id="{{ $obat->id }}" data-harga="{{ $obat->harga }}">
                                                            {{ $obat->nama_obat }} - {{ $obat->kemasan }} - Rp
                                                            {{ number_format($obat->harga, 0, ',', '.') }}
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
        $(function () {
            console.log("Script is running"); // Debug

            const obatSelect = document.getElementById('obat-select');
            const selectedObatsList = document.getElementById('selected-obats-list');
            const selectedObatsContainer = document.getElementById('selected-obats-container');
            const clearAllBtn = document.getElementById('clear-all-obats');
            const biayaInput = document.getElementById('biaya');

            // Set default biaya to 150000
            const defaultBiaya = 150000;
            biayaInput.value = defaultBiaya;

            // Set untuk menyimpan ID obat yang sudah dipilih
            const selectedObats = new Set();

            // Object to store obat prices
            const obatPrices = {};

            // Populate obatPrices with available obat data
            document.querySelectorAll('#obat-select option').forEach(option => {
                if (option.value !== 'Pilih Obat') {
                    // Get price from data-harga attribute if available
                    const harga = option.getAttribute('data-harga');
                    if (harga) {
                        obatPrices[option.value] = parseInt(harga);
                        console.log(`Added price for ${option.value}: ${harga}`); // Debug
                    } else {
                        // Extract price from option text (format: "nama_obat - kemasan - Rp xxx.xxx")
                        const priceText = option.text.split('Rp ')[1];
                        if (priceText) {
                            // Convert formatted price (e.g., "150.000") to number (150000)
                            const price = parseInt(priceText.replace(/\./g, ''));
                            obatPrices[option.value] = price;
                            console.log(`Extracted price for ${option.value}: ${price}`); // Debug
                        }
                    }
                }
            });

            // Calculate total biaya based on selected obat
            function calculateTotalBiaya() {
                console.log("Calculating total..."); // Debug
                let total = defaultBiaya;
                console.log("Initial biaya: " + total); // Debug

                selectedObatsList.querySelectorAll('li').forEach(item => {
                    const obatId = item.dataset.id;
                    const obatHarga = parseInt(item.dataset.harga);
                    
                    console.log(`Obat ID: ${obatId}, Harga from dataset: ${obatHarga}, Harga from object: ${obatPrices[obatId]}`); // Debug
                    
                    if (obatId && obatHarga) {
                        total += obatHarga;
                        console.log(`Added ${obatHarga} from dataset, new total: ${total}`); // Debug
                    } else if (obatId && obatPrices[obatId]) {
                        total += obatPrices[obatId];
                        console.log(`Added ${obatPrices[obatId]} from object, new total: ${total}`); // Debug
                    }
                });

                console.log("Final total: " + total); // Debug
                biayaInput.value = total;
            }

            // Inisialisasi obat yang sudah terpilih sebelumnya
            document.querySelectorAll('#selected-obats-list li').forEach(item => {
                const obatId = item.dataset.id;
                if (obatId) {
                    selectedObats.add(obatId);
                    console.log(`Initialized obat: ${obatId}`); // Debug
                }
            });

            // Calculate initial total based on pre-selected obat
            calculateTotalBiaya();

            // Tambahkan obat ketika dipilih dari dropdown
            obatSelect.addEventListener('change', function () {
                console.log("Obat select changed"); // Debug
                const option = this.options[this.selectedIndex];
                const obatId = option.value;
                const obatText = option.text;

                if (obatId && !selectedObats.has(obatId) && obatId !== 'Pilih Obat') {
                    console.log(`Adding obat: ${obatId} - ${obatText}`); // Debug
                    
                    // Buat elemen list item baru
                    const li = document.createElement('li');
                    li.className = 'list-group-item d-flex justify-content-between align-items-center';
                    li.dataset.id = obatId;

                    // Tambahkan data-harga jika tersedia di option
                    const harga = option.getAttribute('data-harga');
                    if (harga) {
                        li.dataset.harga = harga;
                        console.log(`Setting data-harga: ${harga}`); // Debug
                    }

                    // Isi list item
                    li.innerHTML =
                        `${obatText}<button type="button" class="btn btn-sm btn-danger remove-obat"><i class="fas fa-times"></i></button><input type="hidden" name="obat[]" value="${obatId}">`;

                    // Tambahkan handler untuk tombol hapus
                    const removeBtn = li.querySelector('.remove-obat');
                    removeBtn.addEventListener('click', function () {
                        console.log(`Removing obat: ${obatId}`); // Debug
                        li.remove();
                        selectedObats.delete(obatId);

                        // Sembunyikan container jika tidak ada obat yang dipilih
                        if (selectedObatsList.children.length === 0) {
                            selectedObatsContainer.style.display = 'none';
                        }

                        // Recalculate total biaya after removing obat
                        calculateTotalBiaya();
                    });

                    // Tampilkan container dan tambahkan item
                    selectedObatsContainer.style.display = 'block';
                    selectedObatsList.appendChild(li);

                    // Tambahkan ke set obat yang dipilih
                    selectedObats.add(obatId);
                    console.log(`Added to selected obats set, size now: ${selectedObats.size}`); // Debug

                    // Recalculate total biaya after adding obat
                    calculateTotalBiaya();
                }

                // Reset dropdown ke placeholder
                this.selectedIndex = 0;
            });

            // Handler untuk tombol hapus pada item yang sudah ada
            document.querySelectorAll('.remove-obat').forEach(btn => {
                btn.addEventListener('click', function () {
                    const li = this.closest('li');
                    const obatId = li.dataset.id;
                    console.log(`Removing existing obat: ${obatId}`); // Debug

                    li.remove();
                    selectedObats.delete(obatId);

                    // Sembunyikan container jika tidak ada obat yang dipilih
                    if (selectedObatsList.children.length === 0) {
                        selectedObatsContainer.style.display = 'none';
                    }

                    // Recalculate total biaya after removing obat
                    calculateTotalBiaya();
                });
            });

            // Hapus semua obat yang dipilih
            clearAllBtn.addEventListener('click', function () {
                console.log("Clearing all obats"); // Debug
                selectedObatsList.innerHTML = '';
                selectedObats.clear();
                selectedObatsContainer.style.display = 'none';

                // Reset biaya to default after clearing all obat
                biayaInput.value = defaultBiaya;
            });

            // Sembunyikan container jika tidak ada obat yang dipilih
            if (selectedObatsList.children.length === 0) {
                selectedObatsContainer.style.display = 'none';
            } else {
                console.log(`Initial obat count: ${selectedObatsList.children.length}`); // Debug
            }
        });
    </script>
@endsection