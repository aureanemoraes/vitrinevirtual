@extends('layout.app')

@section('title', 'Vitrine Virtual - Novo produto')

@section('css')
    <style>
        section {
            margin-top: 8px;
        }
        .disabled {
            pointer-events: none;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2>Novo produto</h2>
                <form id="new_product_form" enctype="multipart/form-data">
                    <div class="form-group" id="main_name_container">
                        <label for="main_name">Nome</label>
                        <input type="text" class="form-control" id="main_name" name="main_name" placeholder="Nome do produto...">
                    </div>
                    <div class="form-group" id="description_container">
                        <label for="description">Descrição</label>
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control" placeholder="Descreva seu produto..."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Preço</label>
                        <div class="input-group" id="price_container">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="denheiros">R$</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Preço..." aria-label="price" aria-describedby="denheiros" id="price" name="price">
                        </div>
                    </div>
                    <div class="form-group" id="image_container">
                        <label for="image">Imagens</label>
                        <input type="file" class="form-control" id="image" name="image[]" multiple >
                    </div>
                    <div align="right" style="margin-top: 5px;">
                        <button type="submit" class="btn btn-success" id="submit_button"><span class="cil-check"></span> Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(function() {
            var attributes = [
                'main_name',
                'description',
                'image',
                'price'
            ];

            user_token = localStorage.getItem('token');

            var spinner_login = `
                <div class="spinner-border spinner-border-sm" role="status">
                  <span class="sr-only">Carregando...</span>
                </div>
            `;


            $('#new_product_form').submit((e) => {
                e.preventDefault();
                const fm_product = new FormData(e.target);
                const product_data = Object.fromEntries(fm_product.entries());

                console.log(product_data);

                $('#submit_button').html(spinner_login);
                $("#submit_button").attr("disabled", "disabled");

                attributes.forEach(element => {
                    $(`#invalid-feedback-${element}`).remove();
                    $(`#${element}`).removeClass('is-invalid');
                });

                var login_request = $.ajax({
                    headers: {
                        accept: 'application/json',
                        authorization: `Bearer ${user_token}`
                    },
                    method: "POST",
                    url: "/api/products",
                    data: product_data,

                });

                login_request.done(function( data ) {
                    /*
                    $('#submit_button').text('Salvar e continuar');
                    $("#submit_button").removeAttr("disabled", "disabled");
                    Swal.fire({
                        title: 'Sucesso!',
                        text: 'Produto registrado.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });

                    setTimeout(() => {
                            window.location.replace("/products");
                    },
                    1000);

                     */
                });

                login_request.fail(function( data ) {
                    for (var key in data.responseJSON.data) {
                        attributes.forEach(element => {
                            if(key == element) {
                                $(`#${element}`).addClass('is-invalid');
                                $(`#${element}_container`).append(`
                            <div class="invalid-feedback" id="invalid-feedback-${element}">
                                ${data.responseJSON.data[element]}
                            </div>`);
                            }
                        });
                    }
                    $('#submit_button').text('Salvar e continuar');
                    $("#submit_button").removeAttr("disabled", "disabled");

                });
            });

        });
    </script>
@endsection
