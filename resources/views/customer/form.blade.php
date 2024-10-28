@extends('layouts.app-customer')

@section('content')

<main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
        <div class="card login-card">
            <div class="row no-gutters">
                <div class="col-md-5">
                    <img src="images/login.png" alt="login" class="login-card-img" />
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <h2 class="judul-login">Registrasi Mitra</h2>
                        <form action="{{ route('mitra.store') }}" method="POST">
                            @csrf
                            <p>Nama Toko</p>
                            <div class="form-group">
                                <label for="nama-toko" class="sr-only">Nama Toko</label>
                                <input type="text" name="nama_toko" id="nama_toko"
                                    class="form-control @error('nama_toko') is-invalid @enderror"
                                    placeholder="Masukkan Nama Toko Anda ...." />
                                @error('nama_toko')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <p>Kontak Yang Dapat Dihubungi</p>
                            <div class="form-group">
                                <label for="no_hp_toko" class="sr-only">Kontak Yang Dapat Dihubungi</label>
                                <input type="text" name="no_hp_toko" id="no_hp_toko"
                                    class="form-control @error('no_hp_toko') is-invalid @enderror"
                                    placeholder="Masukkan No. Hp Yang Dapat Dihubungi ...." />
                                @error('no_hp_toko')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <p>Nama Pemilik</p>
                            <div class="form-group">
                                <label for="name" class="sr-only">Nama Pemilik</label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Masukkan Nama Pemilik ...." value="{{ auth()->user()->name }}"
                                    readonly />
                                @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <p>Kategori Usaha</p>
                            <div class="form-group">
                                <label for="kategori" class="sr-only">Kategori Usaha</label>
                                <input type="text" name="kategori" id="kategori"
                                    class="form-control @error('kategori') is-invalid @enderror"
                                    placeholder="Masukkan Kategori Usaha ...." />
                                @error('kategori')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <p>Alamat Toko</p>
                            <div class="form-group">
                                <label for="alamat_toko" class="sr-only">Alamat Toko</label>
                                <input type="text" name="alamat_toko" id="alamat_toko"
                                    class="form-control @error('alamat_toko') is-invalid @enderror"
                                    placeholder="Masukkan Alamat Toko Anda ...." />
                                @error('alamat_toko')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <input name="register" id="register" class="btn btn-block login-btn mb-4" type="submit"
                                value="Register" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
    rel="stylesheet">

<script>
$(document).ready(function() {
    $('#tanggal_lahir').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true
    });
});
</script>

</body>

</html>

@endsection