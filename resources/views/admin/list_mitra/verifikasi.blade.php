@extends('layouts.app-admin')

@section('content')
<main class="content px-3 py-2">
    <div class="container mt-5 card card-body">
        <div class="container mt-4">
            <h2>Verifikasi Data Akun Mitra</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Toko</th>
                        <th>Kontak Toko</th>
                        <th>Nama Pemilik</th>
                        <th>Kategori Usaha</th>
                        <th>Alamat Toko</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mitras as $index => $mitra)
                    <tr>
                        <td>{{ $mitra->nama_toko }}</td>
                        <td>{{ $mitra->no_hp_toko }}</td>
                        <td>{{ $mitra->name }}</td>
                        <td>{{ $mitra->kategori }}</td>
                        <td>{{ $mitra->alamat_toko }}</td>
                        <td>{{ $mitra->status }}</td>
                        <td>
                            <a href="{{ route('admin.list_mitra.show', $mitra->id) }}"
                                class="btn btn-warning btn-sm">Cek
                                Data</a>
                            <form action="#" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
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