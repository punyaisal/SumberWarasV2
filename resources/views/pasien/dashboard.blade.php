@extends('adminlte::page')

@section('title', 'Dashboard Pasien')

@section('content_header')
    <h1>Dashboard Pasien</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-4 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>3</h3>
                    <p>Jumlah Pemeriksaan</p>
                </div>
                <div class="icon">
                    <i class="fas fa-notes-medical"></i>
                </div>
                <a href="#" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-4 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>2</h3>
                    <p>Resep Obat</p>
                </div>
                <div class="icon">
                    <i class="fas fa-prescription-bottle-alt"></i>
                </div>
                <a href="#" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-4 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>5</h3>
                    <p>Riwayat Konsultasi</p>
                </div>
                <div class="icon">
                    <i class="fas fa-file-medical-alt"></i>
                </div>
                <a href="#" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
@stop
