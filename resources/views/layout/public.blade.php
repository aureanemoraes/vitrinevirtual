<!doctype html>
<html lang="pt_br">
<head>
@yield('head_js')
<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CoreUI CSS -->
    <link rel="stylesheet" href="https://unpkg.com/@coreui/coreui/dist/css/coreui.min.css">
    <link rel="stylesheet" href="https://unpkg.com/@coreui/icons@2.0.0-beta.3/css/free.min.css">
    <title>@yield('title')</title>
    <style>
        @yield('css')
        .c-main {
            padding-top: 0;
        }

        .container {
            margin-top: 20px;
            padding: 50px;
        }

        .card-deck{
            margin-top: 10px;
            margin-left: auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            grid-gap: .5rem;
        }

        .card-img-top {
            width: 100%;
            height: 40vh;
            object-fit: cover;
        }


        .carousel img {
            width: 100%;
            object-fit: cover;
            max-height: 400px;
        }

        .c-body {
            background: white;
        }

        .card {
            border: none;
            height: 100%;
        }

        .price {
            width: fit-content;
            font-weight: bold;
            padding: 4px;
        }


        .table th {
            text-align: left;
            vertical-align: middle;
        }


    </style>
</head>
<body class="c-app">
<div class="c-wrapper">
    <header class="c-header navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Vitrine Arte Mulher</a>
        <ul class="nav">
            <a class="nav-link" href="/vitrine" id="users_menu" role="button">
                Todos os produtos
            </a>
            <a class="nav-link" href="/vitrine/empreendedoras" id="products_menu" role="button">
                Nossas empreendedoras
            </a>
            <a class="nav-link" href="/login" id="products_menu" role="button">
                Entrar
            </a>
        </ul>
    </header>
    <div class="c-body">
        <main class="c-main">
            @yield('content')
        </main>
    </div>
    <footer class="c-footer">
    </footer>
</div>
<!-- Optional JavaScript -->
<!-- Popper.js first, then CoreUI JS -->

<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://unpkg.com/@popperjs/core@2"></script>
<script type="text/javascript" src="https://unpkg.com/@coreui/coreui/dist/js/coreui.min.js"></script>
<script type="text/javascript" src="https://unpkg.com/@coreui/coreui/dist/js/coreui.bundle.min.js"></script>
@yield('js')
</body>
</html>
