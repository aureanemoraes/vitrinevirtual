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
    @yield('css')

</head>
<body class="c-app" background="{{asset('assets/girls.png')}}">
<div class="c-wrapper">
    <header class="c-header navbar navbar-expand-lg navbar-light bg-light">
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
