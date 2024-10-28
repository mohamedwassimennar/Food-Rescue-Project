<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Coffside Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" />
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('admin_assets2/css/style.css') }}" />
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar" class="js-sidebar">
            <!-- Content For Sidebar -->
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="#">Mitra Dashboard</a>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-header">Navigation Sidebar</li>
                    <li class="sidebar-item">
                        <a href="{{url('mitra/dashboard')}}" class="sidebar-link">
                            <i class="fa-solid fa-list pe-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{url('menus')}}" class="sidebar-link active">
                            <i class="fa-solid fa-hamburger pe-2"></i>
                            Menu
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{url('stocks')}}" class="sidebar-link">
                            <i class="fa-solid fa-archive pe-2"></i>
                            Stock
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{url('orders')}}" class="sidebar-link">
                            <i class="fa-solid fa-comment-dollar pe-2"></i>
                            Pemesanan
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom">
                <button class="btn" id="sidebar-toggle" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse navbar">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                <img src="{{ asset('images/profile.jpg') }}" class="avatar img-fluid rounded" alt="" />
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="#{{ route('logout') }}" class="dropdown-item">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="content px-3 py-2">
                <div class="container mt-4 card card-body">
                    <h2>Edit Menu</h2>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group"><br>
                            <label for="nama_menu">Nama Menu:</label><br>
                            <input type="text" class="form-control" id="nama_menu" name="nama_menu"
                                value="{{ $menu->nama_menu }}" required>
                        </div><br>
                        <div class="form-group"><br>
                            <label for="nama_toko">Nama Menu:</label><br>
                            <input type="text" class="form-control" id="nama_toko" name="nama_toko"
                                value="{{ $menu->nama_toko }}" readonly>
                        </div><br>
                        <div class="form-group">
                            <label for="kategori_menu">Kategori Menu:</label><br>
                            <select class="form-control" id="kategori_menu" name="kategori_menu" required>
                                <option value="Coffee" {{ $menu->kategori_menu === 'Coffee' ? 'selected' : '' }}>Coffee
                                </option>
                                <option value="Non-Coffee"
                                    {{ $menu->kategori_menu === 'Non-Coffee' ? 'selected' : '' }}>Non-Coffee</option>
                                <option value="Food" {{ $menu->kategori_menu === 'Food' ? 'selected' : '' }}>Food
                                </option>
                            </select>
                        </div><br>

                        <div class="form-group">
                            <label for="gambar_menu">Gambar Menu:</label><br>
                            <input type="file" class="form-control-file" id="gambar_menu" name="gambar_menu"
                                accept="image/*">
                        </div><br>
                        <div class="form-group">
                            <label for="harga_menu">Harga Menu:</label><br>
                            <input type="number" class="form-control" id="harga_menu" name="harga_menu"
                                value="{{ $menu->harga_menu }}" required>
                        </div><br>
                        <div class="d-flex justify-content-between mt-3">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </main>
            <a href="#" class="theme-toggle">
                <i class="fa-regular fa-moon"></i>
                <i class="fa-regular fa-sun"></i>
            </a>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a href="#" class="text-muted">
                                    <strong>Coffside</strong>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('admin_assets2/js/script.js')}}"></script>
</body>

</html>