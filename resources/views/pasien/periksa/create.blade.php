@extends('layouts.app')

@section('title', 'Periksa | Buat Janji')

@section('nav-item')
    <li class="nav-item">
        <a href="/pasien/periksa" class="nav-link">
            <i class="nav-icon fas fa-sharp-duotone fa-solid fa-microscope"></i>
            <p>Periksa</p>
        </a>
    </li>
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Buat Janji Periksa</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/pasien/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="/pasien/periksa">Periksa</a></li>
                        <li class="breadcrumb-item active">Buat Janji Periksa</li>
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
                            <h3 class="card-title">Form Periksa</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="/pasien/periksa">
                            @csrf
                            <div class="card-body">
                                <!-- Pasien Field -->
                                <div class="form-group">
                                    <label for="id-pasien">Pasien</label>
                                    @if(auth()->check() && auth()->user()->role == 'pasien')
                                        <input type="hidden" name="id_pasien" value="{{ auth()->id() }}">
                                        <input type="text" class="form-control" value="{{ auth()->user()->name }}" disabled>
                                    @else
                                        <select class="form-control" id="id-pasien" name="id_pasien">
                                            <option value="">Pilih Pasien</option>
                                            @foreach($pasiens as $pasien)
                                                <option value="{{ $pasien->id }}">{{ $pasien->name }}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                </div>

                                <!-- Dokter Field -->
                                <div class="form-group">
                                    <label for="id-dokter">Dokter</label>
                                    <select class="form-control" id="id-dokter" name="id_dokter">
                                        <option value="">Pilih Dokter</option>
                                        @foreach($dokters as $dokter)
                                            <option value="{{ $dokter->id }}">{{ $dokter->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Tanggal Pemeriksaan Field -->
                                <div class="form-group">
                                    <label for="tgl-periksa">Tanggal Periksa</label>
                                    <input type="datetime-local" class="form-control" id="tgl-periksa" name="tgl_periksa" value="">
                                </div>

                                <!-- Catatan Field -->
                                <div class="form-group">
                                    <label for="catatan">Catatan</label>
                                    <textarea class="form-control" id="catatan" name="catatan" rows="3"></textarea>
                                </div>

                               

                                
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right">Simpan</button>
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