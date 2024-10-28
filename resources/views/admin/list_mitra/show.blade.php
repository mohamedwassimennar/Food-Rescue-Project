@extends('layouts.app-admin')

@section('content')
<main class="content px-3 py-2">
    <div class="container mt-5 card card-body">
        <div class="container mt-4">
            <h1>Lihat Data Verifikasi Mitra</h1>
            <table class="table table-bordered">
                <tr>
                    <th>Nama Toko</th>
                    <td>{{ $mitras->nama_toko }}</td>
                </tr>
                <tr>
                    <th>Kontak Yang Dapat Dihubungi</th>
                    <td>{{ $mitras->no_hp_toko }}</td>
                </tr>
                <tr>
                    <th>Nama Pemilik</th>
                    <td>{{ $mitras->name }}</td>
                </tr>
                <tr>
                    <th>Kategori Usaha</th>
                    <td>{{ $mitras->kategori }}</td>
                </tr>
                <tr>
                    <th>Alamat Toko</th>
                    <td>{{ $mitras->alamat_toko }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        <form method="POST" action="{{ route('mitra.accept', $mitras->id) }}">
            @csrf
            <button type="submit" class="btn btn-success">Terima Mitra</button>
        </form>
    </div>
</main>
@endsection