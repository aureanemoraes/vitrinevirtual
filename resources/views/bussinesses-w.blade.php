@extends('layout.public')

@section('css')

@endsection

@section('content')
    <div class="container">
        <h2>Nossas empreendedoras</h2>
        <div class="row" id="bussinesses_woman">

        </div>
    </div>
@endsection

@section('js')
    <script>
        $.ajax({
            headers: {
                accept: 'application/json',
            },
            method: "GET",
            url: "/api/public/users",
            success: function(data) {
                let users = data.data;
                for(user of users) {
                    $('#bussinesses_woman').append(`
                            <div class="col-sm-6 col-lg-4">
                                <div class="card" style="max-width: 18rem;" >
                                    <div class="card-header bg-facebook content-center">
                                        <i class="fab fa-facebook icon text-white my-4 display-4"></i>
                                       <a href="/vitrine/empreendedoras/${user.id}" class="text-uppercase small" style="font-size: 16px; color: white;">${user.default_name}</a>
                                    </div>
                                    <div class="card-body row text-center">
                                        <div class="col">
                                            <div class="text-value-xl">${user.products_count}</div>
                                            <div class="text-uppercase text-muted small">Produtos</div>
                                        </div>
                                        <div class="vr"></div>
                                    </div>
                                </div>
                            </div>
                    `);
                }
            },
            error: function(data) {
                console.log(data);
            }
        });
    </script>
@endsection
