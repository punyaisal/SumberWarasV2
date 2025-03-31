@extends('adminlte::page')

@section('title', 'Daftar Periksa Dokter')

@section('content_header')
    <h1>Dokter</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Periksa</h3>
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
                        <th>NO</th>
                        <th>ID Periksa</th>
                        <th>Pasien</th>
                        <th>Tanggal Periksa</th>
                        <th>Catatan</th>
                        <th>Biaya Periksa</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>PR001</td>
                        <td>Ahmad</td>
                        <td>2025-03-24 08:00:47</td>
                        <td>Pasien mengalami demam tinggi dan batuk</td>
                        <td>150000</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>PR002</td>
                        <td>Siti</td>
                        <td>2025-03-26 09:30:22</td>
                        <td>Pasien mengeluh sakit perut</td>
                        <td>180000</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>PR003</td>
                        <td>Budi</td>
                        <td>2025-03-27 10:15:35</td>
                        <td>Pasien mengalami sakit kepala dan pusing</td>
                        <td>200000</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>PR004</td>
                        <td>Rina</td>
                        <td>2025-03-28 11:45:12</td>
                        <td>Pasien mengalami nyeri otot</td>
                        <td>175000</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>PR005</td>
                        <td>Joko</td>
                        <td>2025-03-29 13:20:50</td>
                        <td>Pasien mengalami gangguan tidur</td>
                        <td>160000</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop
