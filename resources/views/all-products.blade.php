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

    </style>
@endsection

@section('content')
    <div class="container">
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

        <section style="margin: 20px;" align="center">
            <h3>Nossas vendedoras</h3>
            <div class="list-group" >
            </div>
        </section>

    </div>
@endsection

@section('js')
    <script>
        $(function() {
            user_token = localStorage.getItem('token');

            $.ajax({
                headers: {
                    accept: 'application/json',
                },
                method: "GET",
                url: "/api/public/products/",
                success: function(data) {
                    let products = data.data;
                    console.log(products);
                    if(products.length > 0) {
                        for(let i=0; i<products.length; i++) {
                            if (i == 0) {
                                $('.carousel-indicators').append(`
                                    <li data-target="#carouselProducts" data-slide-to="${i}" class="active"></li>
                                `);
                                $('.carousel-inner').append(`
                                <div class="carousel-item active" align="center">
                                    <img src="/products/${products[i]['images'][0]['path']}" style="width: 500px; height: 500px;"
                                        class="d-block "
                                    />
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>${products[i]['main_name']}</h5>
                                        <p>${products[i]['description']} <a href="/public/products/${products[i]['id']}">Mais informações</a></p>
                                    </div>
                                </div>
                                `);
                            } else {
                                $('.carousel-indicators').append(`
                                    <li data-target="#carouselProducts" data-slide-to="${i}"></li>
                                `);
                                $('.carousel-inner').append(`
                                <div class="carousel-item" align="center">
                                    <img src="/products/${products[i]['images'][0]['path']}" style="width: 500px; height: 500px;"
                                        class="d-block "
                                    />
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>${products[i]['main_name']}</h5>
                                        <p>${products[i]['description']} <a href="/public/products/${products[i]['id']}">Mais informações</a></p>
                                    </div>
                                </div>
                                `);
                            }
                            $('.list-group').append(`
                                <a href="#" class="list-group-item list-group-item-action">${products[i]['user_default_name']}</a>
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

