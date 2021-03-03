@extends('layout.app')

@section('title', 'Vitrine Virtual - Login')

@section('head_js')
    <script>
        let token = localStorage.getItem('token');
        if(token)
            window.location.replace("/home");
    </script>
@endsection

@section('content')
    <div class="container d-flex align-items-center justify-content-center">
        <form id="login_form">
            <div class="card">
                <div class="card-body">
                    <div class="form-group" >
                        <div class="input-group input-group-lg mb-3" id="cpf_container">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="addon-wrapping"><i class="cil-user"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="000.000.000-00" aria-label="cpf" aria-describedby="addon-wrapping" name="cpf" id="cpf">
                        </div>
                    </div>
                    <div class="form-group" >
                        <div class="input-group input-group-lg mb-3" id="password_container">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="addon-wrapping"><i class="cil-lock-locked"></i></span>
                            </div>
                            <input type="password" class="form-control" placeholder="******" aria-label="password" aria-describedby="addon-wrapping" name="password" id="password">
                        </div>
                    </div>
                    <div id="error_container"></div>
                    <div class="form-group ">
                        <button type="submit" class="btn btn-block btn-lg btn-primary" id="submit_button">Entrar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js')

    <script>
        $(function() {
            let submit_button = `<button type="submit" class="btn btn-block btn-primary">Entrar</button>`;
            let spinner_login = `
                <div class="spinner-border text-secondary" role="status">
                  <span class="sr-only">Carregando...</span>
                </div>
            `;

            $('#login_form').submit((e) => {
                e.preventDefault();
                $('#submit_button').html(spinner_login);
                $("#submit_button").attr("disabled", "disabled");

                $('#invalid-feedback-credentials').remove();
                $('#invalid-feedback-cpf').remove();
                $('#invalid-feedback-password').remove();
                $('#cpf').removeClass('is-invalid');
                $('#password').removeClass('is-invalid');


                let cpf = $('#cpf').val();
                let password = $('#password').val();

                let login_request = $.ajax({
                    headers: {
                        accept: 'application/json'
                    },
                    method: "POST",
                    url: "/api/login",
                    data: {
                        cpf: cpf,
                        password: password
                    },
                });

                login_request.done(function( data ) {
                    localStorage.setItem('token', data.data.token);
                    localStorage.setItem('user', data.data.name);
                    $('#submit_button').text('Entrar');
                    $("#submit_button").removeAttr("disabled", "disabled");
                    window.location.replace("/home");
                });

                login_request.fail(function( data ) {
                    console.log(data);
                    $('#submit_button').text('Entrar');
                    $("#submit_button").removeAttr("disabled", "disabled");
                    let errors = data.responseJSON;

                    if(errors.data.error) {
                        $('#error_container').html(`
                        <p style="color:red" id="invalid-feedback-credentials"><span>${errors.data.error}</span></p>
                    `);
                    }

                    if(errors.data.cpf) {
                        $('#cpf').addClass('is-invalid');
                        $('#cpf_container').append(`
                        <div class="invalid-feedback" id="invalid-feedback-cpf">
                            ${errors.data.cpf}
                        </div>
                    `);
                    }

                    if(errors.data.password) {
                        $('#password').addClass('is-invalid');
                        $('#password_container').append(`
                        <div class="invalid-feedback" id="invalid-feedback-password">
                            ${errors.data.password}
                        </div>
                    `);
                    }
                });
            });

            // Máscaras
            $('#cpf').mask('000.000.000-00');
        });
    </script>
@endsection
