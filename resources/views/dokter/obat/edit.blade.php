@extends('layouts.app')

@section('title', 'Obat')

@section('nav-item')
    <li class="nav-item">
        <a href="../memeriksa" class="nav-link">
            <i class="nav-icon fas fa-sharp-duotone fa-solid fa-stethoscope"></i>
            <p>Memeriksa</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="../obat" class="nav-link">
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
                    <h1 class="m-0">Obat</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Obat</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form Edit Obat</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="/dokter/obat/{{ $obat->id }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama-obat">Nama Obat</label>
                                    <input type="text" class="form-control" id="nama-obat" name="nama_obat"
                                     value="{{ $obat->nama_obat}}" />
                                </div>
                                <div class="form-group">
                                    <label for="kemasan">Kemasan</label>
                                    <input type="text" class="form-control" id="kemasan" name="kemasan"
                                    value="{{ $obat->kemasan}}" />
                                </div>
                                <div class="form-group">
                                    <label for="harga-obat">Harga</label>
                                    <input type="number" class="form-control" id="harga-obat" name="harga"
                                    value="{{ $obat->harga}}" />
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
           
            <!-- /.row -->

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection