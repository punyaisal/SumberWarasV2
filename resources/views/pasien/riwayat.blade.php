@extends('adminlte::page')

@section('title', 'Riwayat Pemeriksaan')

@section('content_header')
    <h1>Riwayat Pemeriksaan</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Riwayat</li>
    </ol>
@stop

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
                        <td>C001</td>
                        <td>Dr. Budi</td>
                        <td>20-03-2025</td>
                        <td>Demam ringan</td>
                        <td>Paracetamol</td>
                        <td>150000</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>C002</td>
                        <td>Dr. Siti</td>
                        <td>22-03-2025</td>
                        <td>Flu & Batuk</td>
                        <td>Antibiotik</td>
                        <td>180000</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>C003</td>
                        <td>Dr. Budi</td>
                        <td>23-03-2025</td>
                        <td>Hipertensi</td>
                        <td>Amlodipin</td>
                        <td>200000</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>C004</td>
                        <td>Dr. Joko</td>
                        <td>25-03-2025</td>
                        <td>Gastritis</td>
                        <td>Omeprazole</td>
                        <td>175000</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>C005</td>
                        <td>Dr. Siti</td>
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
