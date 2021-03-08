@extends('layout.public')

@section('title', 'Vitrine Virtual')

@section('css')
@endsection

@section('content')
    <div class="container product">
        <div class="row">
            <div class="col">
                <div id="carouselProduct" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                    </ol>
                    <div class="carousel-inner">
                    </div>
                    <a class="carousel-control-prev" href="#carouselProduct" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselProduct" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="card" >
                    <div class="card-header">
                        <h3 class="card-title" id="card_title"></h3>
                    </div>
                    <div class="card-body">

                        <p class="bg-primary price" id="product_price"></p>
                        <div class="table-responsive-sm">
                            <table class="table table-borderless">
                                <tbody>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="card-footer" id="card_footer">

                    </div>
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

                    $('#card_title').html(product.main_name);
                    $('#product_price').html(`R$ ${product.price}`);

                    if(product.images.length > 0) {
                        for(image of product.images) {
                            if(i == 0) {
                                $('.carousel-indicators').append(`
                                    <li data-target="#carouselProduct" data-slide-to="${i}" class="active"></li>
                                `);
                                $('.carousel-inner').append(`
                                <div class="carousel-item active" align="center" >
                                <img src="/products/${image.path}" style="width: 500px; height: 500px;" class="d-block "/>
                            `);
                            }
                            else {
                                $('.carousel-indicators').append(`
                                    <li data-target="#carouselProduct" data-slide-to="${i}" ></li>
                                `);
                                $('.carousel-inner').append(`
                                <div class="carousel-item " align="center" >
                                <img src="/products/${image.path}" style="width: 500px; height: 500px;" class="d-block "/>
                            `);
                            }
                            i++;
                        }
                    }

                    $('tbody').append(`
                        <tr>
                            <th scope="col">Descrição</th>
                            <td><em>${product.description}</em></td>
                        </tr>
                        <tr>
                            <th scope="col">Formas de pagamento</th>
                            <td>
                                <ul class="list-group list-group-flush" id="pm">
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <th scope="col">Contatos</th>
                            <td>
                                <ul class="list-group list-group-flush" id="phones">
                                </ul>
                            </td>
                        </tr>
                    `);

                    for(pm of product.payment_methods) {
                        $('#pm').append(`
                          <li class="list-group-item">${pm}</li>
                        `);
                    }

                    for(phone of user.phones) {
                        var formatted_phone = phone.number_phone.replace(/[^0-9\.]/g, '');
                        $('#phones').append(`
                          <a href="tel:55${formatted_phone}" class="list-group-item list-group-item-action">${phone.number_phone}</a>
                        `);
                        if(phone.is_whatsapp) {
                            $('#card_footer').append(`
                                <a href="https://api.whatsapp.com/send?phone=55${formatted_phone}" type="button" class="btn btn-success"><i class="cib-whatsapp"></i> Falar no WhatsApp ${phone.number_phone}</a>
                            `);
                        }
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    </script>

@endsection

