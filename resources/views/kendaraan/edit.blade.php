@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Data Kendaraan</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('kelolakendaraan.update', $data->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="merek">Merek Mobil</label>
                            <input type="text" class="form-control" id="merek" name="merek" value="{{ $data->merek }}" required>
                        </div>

                        <div class="form-group">
                            <label for="nama">Model Mobil</label>
                            <input type="text" class="form-control" id="nama" name="model" value="{{ $data->model }}" required>
                        </div>

                        <div class="form-group">
                            <label for="nomor_plat">Nomor Plat</label>
                            <input type="text" class="form-control" id="nomor_plat" name="noplat" value="{{ $data->noplat }}" required>
                        </div>

                        <div class="form-group">
                            <label for="tarif_sewa">Tarif Sewa</label>
                            <input type="number" class="form-control" id="tarif" name="tarif" value="{{ $data->tarif }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary mt-2">Simpan Perubahan</button>
                        <a href="{{ route('kelolakendaraan.index') }}" style="width: 100px" class="btn btn-danger mt-2">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection