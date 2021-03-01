@extends('layout.app')

@section('title', 'Vitrine Virtual - Login')

@section('content')
    <div class="container d-flex align-self-center justify-content-center">
        <form id="login_form">
            <div class="card">
                <div class="card-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="addon-wrapping"><i class="cil-user"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="000.000.000-00" aria-label="cpf" aria-describedby="addon-wrapping" name="cpf" id="cpf">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="addon-wrapping"><i class="cil-lock-locked"></i></span>
                        </div>
                        <input type="password" class="form-control" placeholder="******" aria-label="password" aria-describedby="addon-wrapping" name="password" id="password">
                    </div>
                    <div id="error_container"></div>
                    <div class="form-group mb-3">
                        <button type="submit" class="btn btn-block btn-primary" id="submit_button">Entrar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <script>
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


            let cpf = $('#cpf').val();
            let password = $('#password').val();

            let login_request = $.ajax({
                headers: {
                    accept: 'application/json'
                },
                method: "POST",
                url: "api/login",
                data: {
                    cpf: cpf,
                    password: password
                },
            });

            login_request.done(function( data ) {
                $('#submit_button').text('Entrar');
                $("#submit_button").removeAttr("disabled", "disabled");
                $('#invalid-feedback-credentials').remove();
                $('#invalid-feedback-cpf').remove();
                $('#invalid-feedback-password').remove();

            });

            login_request.fail(function( data ) {
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
                    $('#cpf').after(`
                        <div class="invalid-feedback" id="invalid-feedback-cpf">
                            ${errors.data.cpf}
                        </div>
                    `);
                }

                if(errors.data.password) {
                    $('#password').addClass('is-invalid');
                    $('#password').after(`
                        <div class="invalid-feedback" id="invalid-feedback-password">
                            ${errors.data.password}
                        </div>
                    `);
                }
            });
        });

        $(function() {
        });
    </script>
@endsection
