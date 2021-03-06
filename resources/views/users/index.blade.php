@extends('layout.app')

@section('title', 'Vitrine Virtual - Usuários')

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header">
                <a role="button" class="btn btn-primary btn-lg btn-block" href="/users/create">Novo usuário</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="display" id="users_table">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">CPF</th>
                            <th scope="col">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            //var user = localStorage.getItem('user');
            var user_token = localStorage.getItem('token');

            var table = $('#users_table').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Portuguese-Brasil.json"
                },

                "ajax": {
                    headers: {
                        accept: 'application/json',
                        authorization: `Bearer ${user_token}`
                    },
                    url: "{{url('api/users')}}",
                    dataSrc: "data"
                },
                "columnDefs": [ {
                    "targets": 3,
                    "data": null,
                    "defaultContent": `
                        <button type="button" class="btn btn-sm btn-info show" >Ver</button>
                        <button type="button" class="btn btn-sm btn-warning edit">Alterar</button>
                        <button type="button" class="btn btn-sm btn-danger delete">Remover</button>
                    `
                },
                {
                    "targets": [ 0 ],
                    "visible": false
                }
                ],
                "columns": [
                    {"data": 'id'},
                    {"data": 'name'},
                    {'data': 'cpf'},
                ],


            });

            $('#users_table tbody ').on( 'click', '.edit', function () {
                var data = table.row( $(this).parents('tr') ).data();
                window.location.replace('/users/edit/' + data.id);
            } );

        });
    </script>
@endsection
