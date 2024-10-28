@extends('layouts.app-login')

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
                        <h2 class="judul-login">Sign into your account</h2>
                        <form action="{{ route('login.action') }}" method="POST" class="user">
                            @csrf
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <div class="form-group">
                                <p>Email</p>
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="exampleInputEmail" class="form-control"
                                    placeholder="Masukkan Alamat Email Anda...." />
                            </div>
                            <p>Password</p>
                            <div class="form-group mb-4">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="exampleInputPassword" class="form-control"
                                    placeholder="Masukkan Password Anda...." />
                            </div>
                            <button name="login" id="login" class="btn btn-block login-btn mb-4"
                                type="submit">Login</button>
                        </form>
                        
                        <p class="text-center">Don't have an account? <a
                                href="{{ url('register') }}" class="text-reset">Register here</a></p>
                                <p class="login-card-footer-text text-center">Forgot Password? <a
                                href="{{ url('forgot-password') }}" class="text-reset">Reset Password</a></p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.2/js/bootstrap.min.js"></script>
</body>

@endsection