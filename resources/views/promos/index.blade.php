@extends('layouts.app-admin')

@section('content')
<main class="content px-3 py-2">
    <div class="container-fluid">
        <div class="container mt-4 card card-body">
            <h2>Daftar Promo</h2>
            <div class="mb-5 text-end">
                <a href="{{ route('promos.create') }}" class="btn btn-success">Tambah Promo</a>
            </div>

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Promo</th>
                        <th>Gambar Promo</th>
                        <th>Deskripsi Promo</th>
                        <th>Nilai Potongan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($promos as $index => $promo)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $promo->nama_promo }}</td>
                        <td>
                            <img src="{{ asset($promo->gambar_promo) }}" alt="{{ $promo->nama_promo }}"
                                style="max-width: 100px;">
                        </td>
                        <td>{{ $promo->deskripsi_promo }}</td>
                        <td>{{ $promo->nilai_potongan }}</td>
                        <td>
                            <a href="{{ route('promos.edit', $promo->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('promos.destroy', $promo->id) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection