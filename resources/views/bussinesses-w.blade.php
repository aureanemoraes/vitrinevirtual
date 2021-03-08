@extends('layout.public')

@section('content')
    <div class="container">
        <h2>Nossas empreendedoras</h2>
        <div class="row" id="bussinesses_woman">
            <div class="col-sm-6 col-lg-4">
                <div class="card" style="max-width: 18rem;">
                    <div class="card-header bg-facebook content-center">
                        <i class="fab fa-facebook icon text-white my-4 display-4"></i>
                    </div>
                    <div class="card-body row text-center">
                        <div class="col">
                            <div class="text-value-xl">89k</div>
                            <div class="text-uppercase text-muted small">friends</div>
                        </div>
                        <div class="vr"></div>
                        <div class="col">
                            <div class="text-value-xl">459</div>
                            <div class="text-uppercase text-muted small">feeds</div>
                        </div>
                    </div>
                </div>
            </div>
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
                console.log(data);
            },
            error: function(data) {
                console.log(data);
            }
        });
    </script>
@endsection
