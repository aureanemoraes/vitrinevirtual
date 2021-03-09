@extends('layout.public')

@section('css')
    .c-main {
    padding-top: 0;
    }

    .container {
    margin-top: 20px;
    padding: 50px;
    }

    .card-deck{
    margin-top: 10px;
    margin-left: auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    grid-gap: .5rem;
    }

    .card-img-top {
    width: 100%;
    height: 40vh;
    object-fit: cover;
    }


    .carousel img {
    width: 100%;
    object-fit: cover;
    max-height: 400px;
    }


@endsection
@section('content')
    <div id="caroulseProducts" class="carousel slide " data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#caroulseProducts" data-slide-to="0" class="active"></li>
            <li data-target="#caroulseProducts" data-slide-to="1"></li>
            <li data-target="#caroulseProducts" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://i.pinimg.com/originals/a7/59/cf/a759cf1a81c61662b7fd39aba8c25306.jpg" alt="" />

                <div class="carousel-caption d-none d-md-block">
                    <h5>First slide label</h5>
                    <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://claudia.abril.com.br/wp-content/uploads/2020/12/mother-with-little-daughter-measure-the-fabric-for-sewing.jpg" alt="" />

                <div class="carousel-caption d-none d-md-block">
                    <h5>Second slide label</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://lidesealgomais.files.wordpress.com/2018/04/sem-tc3adtulo-1.png" alt="" />

                <div class="carousel-caption d-none d-md-block" >
                    <h5>Third slide label</h5>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#caroulseProducts" role="button" data-slide="prev"  >
            <span class="carousel-control-prev-icon" aria-hidden="true"</span>
            <span class="sr-only" >Previous</span>
        </a>
        <a class="carousel-control-next" href="#caroulseProducts" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="container">
        <h2>Produtos</h2>
        <div class="card-deck" id="cardDeckProducts">
        </div>

    </div>
@endsection

-@section('js')
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
                          let users = data;
                          let products = [];
                          for(user of users) {
                              if(user.products) {
                                  for(product of user.products) {
                                      products.push(product);
                                  }
                              }
                          }

                          let i = 0;
                          console.log(users, products);
                          for(product of products) {
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
