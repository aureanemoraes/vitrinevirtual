@extends('layout.public')

@section('title', 'Vitrine Virtual')

@section('css')
    <style>
        .list-group {
            background: black;
            opacity: 0.7;

        }
        .list-group-item, h3 {
            color: white;
        }

        .lis-group-item:hover {
            color: cadetblue;
        }

        .card {
            margin: 20px;
            background: white;
            opacity: 0.7;
            color:black;
        }

    </style>
@endsection

@section('content')
    <div class="container">
        <h2 id="product_name"></h2>
        <h3 id="user_name"></h3>
        <div class="cd-example">
            <div id="carouselProducts" class="carousel slide" data-ride="carousel" >
                <ol class="carousel-indicators">
                </ol>
                <div class="carousel-inner">
                </div>
                <a class="carousel-control-prev" href="#carouselProducts" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselProducts" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('js')
    <script>
        $(function() {
            user_token = localStorage.getItem('token');
            const currentURL = $(location).attr('href'); //jQuery solution
            const id = currentURL.substring(currentURL.lastIndexOf('/') + 1);

            $.ajax({
                headers: {
                    accept: 'application/json',
                },
                method: "GET",
                url: "/api/public/products/" + id,
                success: function(data) {
                    let product = data.data;
                    let user = product.user;
                    let i = 0;
                    console.log(product, user);
                    $('#product_name').html(`${product.main_name}`);
                    $('#user_name').html(`Por <strong>${user.default_name}</strong>`);

                    if(product.images.length > 0) {
                        if(i == 0) {
                            $('.carousel-indicators').append(`
                                <li data-target="#carouselProducts" data-slide-to="${i}" class="active"></li>
                            `);
                            $('.carousel-inner').append(`
                                <div class="carousel-item active" align="center">
                                <img src="/products/${product.images[0].path}" style="width: 500px; height: 500px;" class="d-block "/>
                            `);
                        }
                        else {
                            $('.carousel-indicators').append(`
                                <li data-target="#carouselProducts" data-slide-to="${i}"></li>
                            `);
                            $('.carousel-inner').append(`
                                <div class="carousel-item"  align="center">
                                <img src="/products/${product.images[0].path}" style="width: 500px; height: 500px;" class="d-block "/>
                            `);
                        }
                        i++;
                    }

                    $('tbody').append(`
                        <tr>
                            <th scope="col">Nome</th>
                            <td>${product.main_name}</td>
                        </tr>
                        <tr>
                            <th scope="col">Descrição</th>
                            <td>${product.description}</td>
                        </tr>
                        <tr>
                            <th scope="col">Preço</th>
                            <td>${product.price}</td>
                        </tr>
                        <tr>
                            <th scope="col">Formas de pagamento</th>
                            <td>${product.payment_methods}</td>
                        </tr>
                        <tr id="phones">
                            <th scope="col">Contato</th>
                        </tr>
                    `);

                    for(phone of user.phones) {
                        var formatted_phone = phone.number_phone.replace(/[^0-9\.]/g, '');
                        $('#phones').append(`
                            <td>
                                <a href="https://api.whatsapp.com/send?phone=55${formatted_phone}">${phone.number_phone}</a>
                            </td>
                        `);
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    </script>
@endsection

