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
                                <a href="{{ route('logout') }}" class="dropdown-item">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="container mt-4 card card-body">
                        <h2>Daftar Stocks</h2>
                        <div class="mb-5 text-end">
                            <a href="{{ route('stocks.create') }}" class="btn btn-success">Tambah Stock Menu Baru</a>
                        </div>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Menu</th>
                                    <th>Gambar</th>
                                    <th>Jumlah Stock</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stocks as $stock)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <strong>{{ $stock->menu->nama_menu }}</strong><br>
                                    </td>
                                    <td>
                                        <img src="{{ asset($stock->menu->gambar_menu) }}"
                                            alt="{{ $stock->menu->nama_menu }}" style="max-width: 100px;">
                                    </td>
                                    <td>{{ $stock->quantity }}</td>
                                    <td>
                                        <a href="{{ route('stocks.edit', $stock->id) }}" class="btn btn-warning">Tambah
                                            Stock</a>
                                        <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST"
                                            style="display:inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus stok ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3">
                            @if($stocks->previousPageUrl())
                            <a href="{{ $stocks->previousPageUrl() }}" class="btn btn-primary">Previous</a>
                            @endif

                            @if($stocks->nextPageUrl())
                            <a href="{{ $stocks->nextPageUrl() }}" class="btn btn-primary">Next</a>
                            @endif
                        </div>
                    </div>
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