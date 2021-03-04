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
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
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
        {{-----<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>-----}}
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" integrity="sha512-0XDfGxFliYJPFrideYOoxdgNIvrwGTLnmK20xZbCAvPfLGQMzHUsaqZK8ZoH+luXGRxTrS46+Aq400nCnAT0/w==" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://unpkg.com/@popperjs/core@2"></script>
        <script type="text/javascript" src="https://unpkg.com/@coreui/coreui/dist/js/coreui.min.js"></script>
        <script type="text/javascript" src="https://unpkg.com/@coreui/coreui/dist/js/coreui.bundle.min.js"></script>
        @yield('js')
        <script>
             user = localStorage.getItem('user');
             user_token = localStorage.getItem('token');

             if(user_token) {
                 let auth_request = $.ajax({
                     headers: {
                         accept: 'application/json',
                         authorization: `Bearer ${user_token}`
                     },
                     method: "get",
                     url: "/api/users",
                 });

                 auth_request.done(function( data ) {
                 });

                 auth_request.fail(function( data ) {
                     const currentURL = $(location).attr('href'); //jQuery solution

                     localStorage.removeItem('token');
                     localStorage.removeItem('user');
                     if(currentURL != 'http://vitrine_virtual.test/login')
                         window.location.replace("/login");

                     console.log(data);
                 });
             }

            if(user) {
                let nav_bar = `
                <div class="col">
                    <a class="navbar-brand" href="#">Navbar</a>
                    <ul class="nav">
                        <a class="nav-link" href="/users" id="users_menu" role="button">
                            Usuários
                        </a>
                        <a class="nav-link" href="/products" id="products_menu" role="button">
                            Produtos
                        </a>
                    </ul>

                </div>
                <div class="col" align="right">
                    ${user} <button class="btn btn-secondary" type="button" id="loggout_button">Sair</button>
                </div>
                `;
                $('.c-header').append(nav_bar);
            }
            $(function() {
                let submit_button = `<button type="submit" class="btn btn-block btn-primary">Entrar</button>`;
                let spinner_login = `
                <div class="spinner-border text-secondary" role="status">
                  <span class="sr-only">Carregando...</span>
                </div>
            `;

                $('#loggout_button').click(() => {
                    let login_request = $.ajax({
                        headers: {
                            accept: 'application/json',
                            authorization: `Bearer ${user_token}`
                        },
                        method: "POST",
                        url: "/api/logout",
                    });

                    login_request.done(function( data ) {
                        localStorage.removeItem('token');
                        localStorage.removeItem('user');
                        window.location.replace("/login");
                    });

                    login_request.fail(function( data ) {
                        console.log(data);
                    });
                });
            });

        </script>
    </body>
</html>
