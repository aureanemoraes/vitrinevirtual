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
        img {
            border: 1px solid black;
            margin: 2px;
        }
        input[type="file"] {
            margin-top: 5px;
        }
        .heading {
            font-family: Montserrat;
            font-size: 45px;
            color: green;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2>Novo produto</h2>
                <form id="new_product_form" enctype="multipart/form-data" method="POST">
                    <div class="form-group" id="main_name_container">
                        <label for="main_name">Nome</label>
                        <input type="text" class="form-control" id="main_name" name="main_name" placeholder="Nome do produto...">
                    </div>
                    <div class="form-group" id="description_container">
                        <label for="description">Descrição</label>
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control" placeholder="Descreva seu produto..."></textarea>
                    </div>
                    <div class="form-group" id="image_container">
                        <label for="image">Imagens</label>
                        <input type="file" class="form-control" id="image" name="image[]" multiple >
                    </div>
                    <div class="holder">
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
                    <div class="form-group" id="payment_methods_cotainer">
                        <label>Formas de pagamento</label>
                        <div class="form-check" >
                            <input class="form-check-input" type="checkbox" value="Dinheiro" id="pm_money" name="payment_methods[]">
                            <label class="form-check-label" for="pm_money">
                                Dinheiro
                            </label>
                        </div>
                        <div class="form-check" >
                            <input class="form-check-input" type="checkbox" value="Cartão de crédito" id="pm_credit_card" name="payment_methods[]">
                            <label class="form-check-label" for="pm_credit_card">
                                Cartão de crédito
                            </label>
                        </div>
                        <div class="form-check" >
                            <input class="form-check-input" type="checkbox" value="Cartão de débito" id="pm_debit_card" name="payment_methods[]">
                            <label class="form-check-label" for="pm_debit_card">
                                Cartão de Débito
                            </label>
                        </div>
                        <div class="form-check" >
                            <input class="form-check-input" type="checkbox" value="PIX" id="pm_pix" name="payment_methods[]">
                            <label class="form-check-label" for="pm_pix">
                                PIX
                            </label>
                        </div>
                        <div class="form-check" >
                            <input class="form-check-input" type="checkbox" value="Transferência bancária" id="pm_bank_transfer" name="payment_methods[]">
                            <label class="form-check-label" for="pm_bank_transfer">
                                Transferência bancária
                            </label>
                        </div>
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
                'price',
                'payment_methods'
            ];

            user_token = localStorage.getItem('token');

            var spinner_login = `
                <div class="spinner-border spinner-border-sm" role="status">
                  <span class="sr-only">Carregando...</span>
                </div>
            `;

            $('#image').change(function(){
                $('.holder').html("");
                if(this.files.length > 0 && this.files.length <= 3) {
                    for(let i=0; i<this.files.length; i++) {
                        let file = this.files[i];
                        if (file) {
                            let reader = new FileReader();
                            reader.onload = function(event){
                                $('.holder').append(`<img src="${event.target.result}" alt="pic" style="width:80px;height: 80px;"/>`);
                            }
                            reader.readAsDataURL(file);

                        }
                    }
                } else {
                    $('#image').val(null);

                    alert('O máximo de imagens permitidas é 3.');
                }

            });

        $('#new_product_form').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    headers: {
                        accept: 'application/json',
                        authorization: `Bearer ${user_token}`
                    },
                    type:'POST',
                    url: "/api/products",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        Swal.fire({
                            title: 'Sucesso!',
                            text: 'Produto registrado.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });

                        setTimeout(() => {
                                window.location.replace("/products/all");
                            },
                            1000);
                    },
                    error: function(data){
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
                        $('#address_submit_button').text('Salvar');
                        $("#address_submit_button").removeAttr("disabled", "disabled");
                    }
                });
            });
            $('#price').mask('000 000 000 000 000.00', {reverse: true});

        });
    </script>
@endsection
