@extends('adminlte::page')

@section('title', 'Form Pemeriksaan Pasien')

@section('content_header')
    <h1>Pemeriksaan Pasien</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Form Pemeriksaan</li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title">Form Pemeriksaan</h3>
        </div>
        <div class="card-body">
            <form>
                <div class="form-group">
                    <label for="namaPasien">Nama Pasien</label>
                    <input type="text" class="form-control" id="namaPasien" placeholder="Masukkan nama pasien">
                </div>
                
                <div class="form-group">
                    <label for="dokter">Pilih Dokter</label>
                    <select class="form-control" id="dokter">
                        <option>Dr. Budi</option>
                        <option>Dr. Siti</option>
                        <option>Dr. Joko</option>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-primary">Kirim</button>
            </form>
        </div>
    </div>
@stop
