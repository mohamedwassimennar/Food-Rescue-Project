<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <title>Coffside Web</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #ecede8;">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('images/logo-1.png') }}" alt="Coffside Logo" width="80" height="40">

            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('promo') }}">Promo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('menu') }}">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('login') }}">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <img src="{{ asset('images/banner-2.png') }}" class="d-block w-100">

    <div class="container">
        <h2 class="promo-heading mt-4">Coffside #Donation</h2>
        <h5 class="banner-text">We're on a mission to turn every our products into a force for good. 10% of our income
            goes directly to
            supporting the warriors in the battle against cancer.
            <br>
            <br>Every cup you enjoy at COFFSIDE is a contribution to the fight against cancer. Your choice helps fund
            research, support patients, and brings us one step closer to a world without this devastating disease.
            <br>
            <br>Together, We Stand Strong.
        </h5>
    </div>
    <br><br><br><br>
    <footer style="background-color: #265171; color: #ffffff; padding: 20px;">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h4>COFFSIDE</h4>
                    <p>Our Location</p>
                    <p>Kantin Vokasi UI, Kukusam Kecamatan Beji, Kota Depok, Jawa Barat 16245</p>
                    <a href="https://www.instagram.com/coffside.id/" target="_blank">
                        <img src="{{ asset('images/logo/instagram-logo.png') }}" alt="Instagram" width="30" height="30">
                    </a>
                    <a href="https://www.tiktok.com/@coffside.id" target="_blank">
                        <img src="{{ asset('images/logo/tiktok-logo.png') }}" alt="TikTok" width="30" height="30">
                    </a>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>