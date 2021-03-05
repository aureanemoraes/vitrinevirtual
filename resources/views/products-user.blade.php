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

    </style>
@endsection

@section('content')
    <div class="container">
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
                url: "/api/public/products/user/" + id,
                success: function(data) {
                    let user = data[0];
                    let products = user.products;
                    $('#user_name').html(`${user.name}`);
                    let i = 0;
                    console.log(user, products);
                    if(products.length > 0) {
                        for(product of products) {
                            if(product.images.length > 0) {
                                if(i == 0) {
                                    $('.carousel-indicators').append(`
                                        <li data-target="#carouselProducts" data-slide-to="${i}" class="active"></li>
                                    `);
                                    $('.carousel-inner').append(`
                                        <div class="carousel-item active" align="center">
                                        <img src="/products/${product.images[0].path}" style="width: 500px; height: 500px;" class="d-block "/>
                                        <div class="carousel-caption d-md-block">
                                                <h5>${product.main_name}</h5>
                                                <p>${product.description} <a href="/vitrine/produto/${product.id}">Mais informações</a></p>
                                            </div>
                                        </div>
                                    `);
                                }
                                else {
                                    $('.carousel-indicators').append(`
                                        <li data-target="#carouselProducts" data-slide-to="${i}"></li>
                                    `);
                                    $('.carousel-inner').append(`
                                        <div class="carousel-item"  align="center">
                                        <img src="/products/${product.images[0].path}" style="width: 500px; height: 500px;" class="d-block "/>
                                        <div class="carousel-caption d-md-block">
                                                <h5>${product.main_name}</h5>
                                                <p>${product.description} <a href="/vitrine/produto/${product.id}">Mais informações</a></p>
                                            </div>
                                        </div>
                                    `);
                                }
                                i++;
                            }
                        }
                    } else {
                        $('.carousel-indicators').append(`
                            <li data-target="#carouselProducts" data-slide-to="0" class="active"></li>
                        `);
                        $('.carousel-inner').append(`
                            <div class="carousel-item active" align="center">
                            <svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="400" xmlns="http://www.w3.org/2000/svg" aria-label="Placeholder: First slide" preserveAspectRatio="xMidYMid slice" role="img">
                            <title>Placeholder</title><rect width="100%" height="100%" fill="#777"/><text x="50%" y="50%" fill="#555" dy=".3em">:(</text>
                            </svg>
                            <div class="carousel-caption d-md-block">
                                    <h5>Não há produtos disponíveis.</h5>
                                    <p>O vendedor não possui nenhum produto cadastrado.</p>
                                </div>
                            </div>
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

