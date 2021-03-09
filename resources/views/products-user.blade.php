@extends('layout.public')

@section('title', 'Vitrine Virtual')

@section('css')
    .profile {
    max-width: 150px;
    max-height: 150px;
    }
    .jumbotron {
    padding-top: 5px !important;
    padding-bottom: 5px !important;
    }

@endsection

@section('content')
    <div class="jumbotron jumbotron-fluid">
        <div class="container" id="user_info">
        </div>
    </div>
    <div class="container">
        <h2>Produtos</h2>
        <div class="card-deck" id="cardDeckProducts">
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
                    $('#user_info').append(`
                        <h1 class="display-9">Olá, me chamo <strong>${user.default_name}</strong>.</h1>
                        <p class="lead">Tenho ${user.age} anos, sou microempreendora individual e tenhos ${user.products_count} produtos em oferta.</p>
                    `);
                    for(product of user.products) {
                        if(product.images.length > 0) {
                            $('#cardDeckProducts').append(`
                                 <div class="card">
                                 <img
                                 src="/products/${product.images[0].path}"
                                 alt=""
                                 class="bd-placeholder-img card-img-top"
                                width="100"
                                heigh="300"/>
                                     <div class="card-body">
                                         <h5 class="card-title">${product.main_name}</h5>
                                         <p class="card-text">${product.description}</p>
                                     </div>
                                     <div class="card-footer">
                                         <small class="text-muted"><a href="/vitrine/produto/${product.id}">Mais informações <i class="cil-arrow-right"></i></a></small>
                                     </div>
                                 </div>
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

