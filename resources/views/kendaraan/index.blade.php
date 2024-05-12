@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Data Kendaraan</div>
                <a href="{{ route('kelolakendaraan.create') }}" style="width: 100px" class="btn btn-primary btn-sm mt-2">Tambah  Kendaraan</a>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Merek Mobil</th>
                                <th>Nama Mobil</th>
                                <th>Nomor Plat</th>
                                <th>Tarif Sewa</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $kendaraan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kendaraan->merek }}</td>
                                <td>{{ $kendaraan->model }}</td>
                                <td>{{ $kendaraan->noplat }}</td>
                                <td>{{ $kendaraan->tarif }}</td>
                                <td>
                                    <a href="{{ route('kelolakendaraan.edit', $kendaraan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('kelolakendaraan.destroy', $kendaraan->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection