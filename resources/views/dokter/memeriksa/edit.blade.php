@extends('layouts.app')

@section('title', 'Sugeng | Edit Pemeriksaan')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form Pemeriksaan</h3>
                        </div>

                        <!-- form start -->
                        <form method="POST" action="/dokter/memeriksa/{{ $periksa->id }}">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama_pasien">Nama Pasien</label>
                                    <input type="text" class="form-control" id="nama_pasien" name="nama"
                                           value="{{ $periksa->pasien->nama }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="tgl">Tanggal</label>
                                    <input type="date" class="form-control" id="tgl" name="tgl_periksa"
                                           value="{{ $periksa->tgl_periksa }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="catatan">Catatan</label>
                                    <input type="text" class="form-control" id="catatan" name="catatan"
                                           value="{{ $periksa->catatan }}" required>
                                </div>

                                <div class="form-group">
                                    <label>Obat</label>
                                    <select class="form-control" name="obat[]" multiple>
                                        @foreach($obat as $obat_item)
                                            <option value="{{ $obat_item->id }}"
                                                    @if(in_array($obat_item->id, $selected_obats)) selected @endif>
                                                {{ $obat_item->nama_obat }} - {{ $obat_item->kemasan }} - Rp {{ number_format($obat_item->harga, 0, ',', '.') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="biaya">Biaya Periksa dan Obat</label>
                                    <input type="number" class="form-control" id="biaya" name="biaya_periksa"
                                           value="{{ $periksa->biaya_periksa }}" readonly>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
