<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RescueFood Admin Dashboard</title>
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
                                <a href="{{ route('logout') }}" class="dropdown-item">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="main">
                <main class="content px-3 py-2">
                    <div class="container mt-5 card card-body">
                        <h2>Edit Order</h2>
                        <form action="{{ route('orders.update', $order->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group"><br>
                                <label for="menu_id">Menu:</label>
                                <select name="menu_id" id="menu_id" class="form-control">
                                    @foreach($menus as $menu)
                                    <option value="{{ $menu->id }}"
                                        {{ $menu->id === $order->menu_id ? 'selected' : '' }}>
                                        {{ $menu->nama_menu }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group"><br>
                                <label for="promo_id">Promo:</label>
                                <select name="promo_id" id="promo_id" class="form-control">
                                    <option value="" {{ $order->promo_id === null ? 'selected' : '' }}>No Promo</option>
                                    @foreach($promos as $promo)
                                    <option value="{{ $promo->id }}"
                                        {{ $promo->id === $order->promo_id ? 'selected' : '' }}>
                                        {{ $promo->nama_promo }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group"><br>
                                <label for="user_id">User:</label>
                                <select name="user_id" id="user_id" class="form-control">
                                    @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}"
                                        {{ $customer->id === $order->user_id ? 'selected' : '' }}>
                                        {{ $customer->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group"><br>
                                <label for="quantity">Quantity:</label>
                                <input type="number" name="quantity" id="quantity" class="form-control"
                                    value="{{ $order->quantity }}" required>
                            </div><br>
                            <div class="form-group">
                                <label for="status">Status:</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="Pesanan Sedang Dipersiapkan"
                                        {{ $order->status === 'Pesanan Sedang Dipersiapkan' ? 'selected' : '' }}>
                                        Pesanan Sedang Dipersiapkan
                                    </option>
                                    <option value="Pesanan Siap"
                                        {{ $order->status === 'Pesanan Siap' ? 'selected' : '' }}>
                                        Pesanan Siap
                                    </option>
                                </select>
                            </div>
                            <div class="d-flex justify-content-between mt-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('orders.index') }}" class="btn btn-secondary">Kembali</a>
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