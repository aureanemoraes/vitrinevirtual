@extends('layout.app')

@section('title', 'Vitrine Virtual - Alterar produto')

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
                <form id="update_product_form" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
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
                    <div class="holder"></div>
                    <table class="table" id="image_table">
                        <thead>
                            <th>Imagem</th>
                            <th>Ordem</th>
                            <th>Ações</th>
                        </thead>
                        <tbody></tbody>
                    </table>
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
        let product;

        let total_images;

        function deleteImage(id) {
            $.ajax({
                headers: {
                    accept: 'application/json',
                    authorization: `Bearer ${user_token}`
                },
                method: "DELETE",
                url: "/api/images/" + id,
                success: function(data) {
                    total_images -= 1;
                    $(`#image_${id}`).remove();
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }

        $(function() {
            var attributes = [
                'main_name',
                'description',
                'image',
                'price',
                'payment_methods'
            ];

            var image_attributes = [
                'path',
                'order',
            ];


            user_token = localStorage.getItem('token');

            // Alimentando com os dados do usuário
            const currentURL = $(location).attr('href'); //jQuery solution
            const id = currentURL.substring(currentURL.lastIndexOf('/') + 1);

            // Buscar dados do usuários
            var login_request = $.ajax({
                headers: {
                    accept: 'application/json',
                    authorization: `Bearer ${user_token}`
                },
                method: "GET",
                url: "/api/products/" + id,
            });

            login_request.done(function( data ) {
                product = data.data;
                total_images = product['images'].length;
                for(u in product) {
                    attributes.forEach(element => {
                        if(element == u) {
                            $(`#${element}`).val(product[u]);;
                        }
                    })
                }
                if(total_images > 0) {
                    product['images'].forEach(element => {
                        $('#image_table tbody').append(`
                            <tr id="image_${element['id']}">
                                <td><img src="/products/${element['path']}" alt="pic" style="width:80px;height: 80px;"/></td>
                                <td>${element['order']}</td>
                                <td><button type="button" class="btn btn-danger" onclick="deleteImage('${element['id']}')">Remover</button></td>
                            </tr>
                        `);
                    });
                }

                if(product['payment_methods'].length > 0) {
                    let checkboxes = $('.form-check-input');
                    product['payment_methods'].forEach(element => {
                        for(a of checkboxes) {
                            if(a.value == element) {
                                a.checked = true;
                            }
                        }
                    });
                }
            });

            login_request.fail(function( data ) {
            });

            var spinner_login = `
                <div class="spinner-border spinner-border-sm" role="status">
                  <span class="sr-only">Carregando...</span>
                </div>
            `;

            $('#image').change(function(){
                $('.holder').html("");
                if(this.files.length > 0 && this.files.length <= 3) {
                    avaliable = 3 - total_images ;
                    avaliable = avaliable - this.files.length
                    if( avaliable < 0) {
                        $('#image').val(null);
                        alert('O máximo de imagens permitidas é 3.');
                    } else {
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
                    }
                } else {
                    $('#image').val(null);
                    alert('O máximo de imagens permitidas é 3.');
                }

            });

            $('#update_product_form').submit(function(e) {
                e.preventDefault();
                var formUpdate = new FormData(this);
                let TotalImages = $('#image')[0].files.length; //Total Images
                for (let i = 0; i < TotalImages; i++) {
                    formUpdate.append('total_image', TotalImages);
                }


                $.ajax({
                    headers: {
                        accept: 'application/json',
                        authorization: `Bearer ${user_token}`
                    },
                    type:'post',
                    url: "/api/products/" + id,
                    data: formUpdate,
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
                        console.log(data);
                    }
                });
            });
            $('#price').mask('000 000 000 000 000.00', {reverse: true});
        });
    </script>
@endsection
