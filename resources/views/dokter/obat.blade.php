@extends('adminlte::page')

@section('title', 'Kelola Obat')

@section('content_header')
    <h1>Dokter</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header bg-primary">
            <h3 class="card-title">Obat</h3>
        </div>
        <div class="card-body">
            <form>
                <div class="form-group">
                    <label for="namaObat">Nama Obat</label>
                    <input type="text" class="form-control" id="namaObat" placeholder="Masukkan nama obat">
                </div>
                
                <div class="form-group">
                    <label for="kemasan">Kemasan</label>
                    <input type="text" class="form-control" id="kemasan" placeholder="Masukkan jenis kemasan">
                </div>
                
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="text" class="form-control" id="harga" placeholder="Masukkan harga">
                </div>
                
                <button type="submit" class="btn btn-primary">Tambah Obat</button>
            </form>
        </div>
    </div>
    
    <div class="card mt-4">
        <div class="card-header">
            <h3 class="card-title">List Obat</h3>
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
                        <th>ID Obat</th>
                        <th>Nama Obat</th>
                        <th>Kemasan</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>OB101</td>
                        <td>Amoxicillin</td>
                        <td>Strip</td>
                        <td>30000</td>
                        <td>
                            <button class="btn btn-sm btn-warning">Edit</button>
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>OB102</td>
                        <td>Ibuprofen</td>
                        <td>Botol</td>
                        <td>40000</td>
                        <td>
                            <button class="btn btn-sm btn-warning">Edit</button>
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>OB103</td>
                        <td>Omeprazole</td>
                        <td>Box</td>
                        <td>50000</td>
                        <td>
                            <button class="btn btn-sm btn-warning">Edit</button>
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>OB104</td>
                        <td>Metformin</td>
                        <td>Pil</td>
                        <td>35000</td>
                        <td>
                            <button class="btn btn-sm btn-warning">Edit</button>
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>OB105</td>
                        <td>Vitamin C</td>
                        <td>Sachet</td>
                        <td>20000</td>
                        <td>
                            <button class="btn btn-sm btn-warning">Edit</button>
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop
