@extends('layouts.app')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- Tampilkan pesan kesalahan -->
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<div class="container">
    <div class="row">
        @foreach ($data as $kendaraan)
        <div class="col-md-3">
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('assets/mobil.jpg') }}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Merek :{{ $kendaraan->merek }} </h5>
                  <h5 class="card-title">Model :{{ $kendaraan->model }} </h5>
                  <h5 class="card-title">No Polisi :{{ $kendaraan->noplat }} </h5>
                  <h5 class="card-title">Tarif Sewa/Hari :{{ $kendaraan->tarif }}</h5>
                  <div class="text-end">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $kendaraan->id }}">Sewa</button>
                  </div>
                </div>
              </div>
        </div>
        @endforeach
    </div>
    <!-- Modal -->

    @foreach ($data as $kendaraan)
  <div class="modal fade" id="exampleModal{{ $kendaraan->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Penyewaan</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="{{ route('penyewaan.store') }}">
            @csrf
        <div class="modal-body">
          
                <input type="text" class="form-control mt-2" id="merek" name="iduser" value=" {{ Auth::user()->id }}" hidden >
                <input type="text" class="form-control mt-2" id="merek" name="idkendaraan" value=" {{ $kendaraan->id }}" hidden>
                <div class="form-group">
                    <label for="merek">Tanggal Sewa</label>
                    <input type="date" class="form-control mt-2" id="merek" name="tanggalsewa" required>
                </div>

                <div class="form-group">
                    <label for="nama">Tanggal Pengembalian</label>
                    <input type="date" class="form-control mt-2" id="nama" name="tanggalkembali" required>
                </div>
           
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>  
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  @endforeach
</div>
@endsection
