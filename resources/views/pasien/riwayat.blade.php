@extends('layouts.app')

@section('title', 'Riwayat Pemeriksaan')

@section('nav-item')
    <li class="nav-item">
        <a href="./periksa" class="nav-link">
            <i class="nav-icon fas fa-sharp-duotone fa-solid fa-microscope"></i>
            <p>Periksa</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="./riwayat" class="nav-link">
            <i class="nav-icon fas fa-solid fa-file-medical"></i>
            <p>Riwayat</p>
        </a>
    </li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Riwayat Pemeriksaan Pasien</h3>
            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Cari">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Pemeriksaan</th>
                        <th>Nama Dokter</th>
                        <th>Tanggal</th>
                        <th>Diagnosa</th>
                        <th>Resep Obat</th>
                        <th>Biaya</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>A001</td>
                        <td>Dr. John son</td>
                        <td>20-03-2025</td>
                        <td>Demam ringan</td>
                        <td>Paracetamol</td>
                        <td>150000</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>A002</td>
                        <td>Dr. John Dan</td>
                        <td>22-03-2025</td>
                        <td>Flu & Batuk</td>
                        <td>Antibiotik</td>
                        <td>180000</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>A003</td>
                        <td>Dr. John Son</td>
                        <td>23-03-2025</td>
                        <td>Hipertensi</td>
                        <td>Amlodipin</td>
                        <td>200000</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>A004</td>
                        <td>Dr. John Dan</td>
                        <td>25-03-2025</td>
                        <td>Gastritis</td>
                        <td>Omeprazole</td>
                        <td>175000</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>A005</td>
                        <td>Dr. John Son</td>
                        <td>27-03-2025</td>
                        <td>Anemia</td>
                        <td>Tablet Zat Besi</td>
                        <td>190000</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop