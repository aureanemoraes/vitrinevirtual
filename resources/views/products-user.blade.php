@extends('layout.public')

@section('title', 'Vitrine Virtual')

@section('css')
    body {
        background: #F1F3FA;
    }

    /* Profile container */
    .profile {
        margin: 20px 0;
    }

    /* Profile sidebar */
    .profile-sidebar {
        padding: 20px 0 10px 0;
        background: #fff;
    }

    .profile-userpic img {
        float: none;
        margin: 0 auto;
        width: 50%;
        height: 50%;
        -webkit-border-radius: 50% !important;
        -moz-border-radius: 50% !important;
        border-radius: 50% !important;
    }

    .profile-usertitle {
        text-align: center;
        margin-top: 20px;
    }

    .profile-usertitle-name {
        color: #5a7391;
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 7px;
    }

    .profile-usertitle-job {
        text-transform: uppercase;
        color: #5b9bd1;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 15px;
    }

    /* Profile Content */
    .profile-content {
        padding: 20px;
        background: #fff;
        min-height: 460px;
    }
@endsection

@section('content')
    <div class="container">
        <div class="row profile">
            <div class="col-md-3">
                <div class="profile-sidebar">
                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic" align="center">
                        <img src="https://economia.estadao.com.br/blogs/sua-oportunidade/wp-content/uploads/sites/49/2018/03/woman-868534_960_720.jpg" class="img-responsive" alt="">
                    </div>
                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name">
                        </div>
                        <div class="profile-usertitle-job">
                        </div>
                    </div>
                    <!-- END MENU -->
                </div>
            </div>
            <div class="col-md-9">
                <div class="profile-content">
                    <h3>Meus produtos</h3>
                    <div class="card-deck" id="cardDeckProducts">
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
                url: "/api/public/products/user/" + id,
                success: function(data) {
                    let user = data[0];
                    $('.profile-usertitle-name').html(user.default_name);
                    $('.profile-usertitle-job').html('Microempreendedora');

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

