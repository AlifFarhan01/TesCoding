@extends('layouts.app')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Formulir Pencarian</div>

                <div class="card-body">
                    <form action="{{ route('pengembalian.search') }}" method="GET">
                        <div class="form-row">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Cari Nomor Plat Mobil yang di sewa" name="noplat" required>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@if(isset($data))
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Hasil Pencarian Berdasarkan Nomor Plat Kendaraan</div>
                    <div class="row justify-content-center">
                        @if(count($data) > 0)
                        @foreach($data as $sewa)
                        <div class="col-md-4">
                            <form method="POST" action="{{ route('pengembalian.update', $sewa->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="card-body">                       
                                    <div class="card" style="width: 15rem;">
                                        <img src="{{ asset('assets/mobil.jpg') }}" class="card-img-top" alt="...">
                                        <div class="card-body">
                                        <h6 class="card-title">Merek Mobil :{{ $sewa->kendaraan->merek }} </h6>
                                        <h6 class="card-title">Model :{{ $sewa->kendaraan->model }} </h6>
                                        <h6 class="card-title">No Polisi :{{ $sewa->kendaraan->noplat }} </h6>
                                        <h6 class="card-title">Tanggal Sewa :{{ $sewa->tanggalsewa }} </h6>
                                        <h6 class="card-title">Tanggal Kembali :{{ $sewa->tanggalkembali }} </h6>
                                        <h6 class="card-title">Tarif Sewa/Hari :{{ $sewa->kendaraan->tarif }}</h6>
                                        <h6 class="card-title">Total Biaya:{{ $sewa->total_biaya }}</h6>
                                        <input type="text" name="totaltarif" value="{{ $sewa->total_biaya }}"hidden>
                                        <input type="text" name="status" value="dikembalikan"hidden>
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-warning">Kembalikan</button>
                                        </div>
                                        </div>
                                    </div>              
                                </div>
                            </form>
                        </div>
                        @endforeach
                        @else
                        <p>Tidak ada data ditemukan.</p>
                        @endif
                    </div>      
            </div>
        </div>
    </div>
</div>
@endif
@endsection
