@extends('layout.app')

@section('title', 'Vitrine Virtual - Novo usuário')

@section('css')
    <style>
        section {
            margin-top: 8px;
        }
        .disabled {
            pointer-events: none;
        }
    </style>
@endsection

@section('content')
    <div class="container">


        <div class="card">
            <div class="card-body">
                <h2>Novo usuário</h2>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#user_tab" id="user_tab_link">Usuário</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#address_tab" id="address_tab_link">Endereço</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#phone_tab" id="phone_tab_link">Contatos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#social_media_tab" id="social_media_tab_link">Redes sociais</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div id="user_tab" class="container tab-pane active"><br>
                        <form id="new_user_form">
                            <section>
                                <h3>Dados pessoais</h3>
                                <div class="form-row">
                                    <div class="form-group col" id="name_container">
                                        <label for="name">Nome completo</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Nome completo...">
                                    </div>
                                    <div class="form-group col" id="social_name_container">
                                        <label for="social_name">Nome social</label>
                                        <input type="text" class="form-control" id="social_name" name="social_name" placeholder="Nome social...">
                                        <small id="social_nameHelpInline" class="text-muted" style="padding-left: 25px">
                                            <input class="form-check-input" type="checkbox" id="social_name_check">
                                            <label class="form-check-label" for="social_name_check">
                                                Não se aplica
                                            </label>
                                        </small>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col" id="cpf_container">
                                        <label for="cpf">CPF</label>
                                        <input type="text" class="form-control" id="cpf" name="cpf" placeholder="999.999.999-99">
                                    </div>
                                    <div class="form-group col" id="rg_container">
                                        <label for="rg">RG</label>
                                        <input type="text" class="form-control" id="rg" name="rg" placeholder="999999">
                                    </div>
                                    <div class="form-group col" id="uf_rg_container">
                                        <label for="uf_rg">UF do RG</label>
                                        <select id="uf_rg" name="uf_rg" class="form-control">
                                            <option selected disabled>Selecione...</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col" id="birthdate_container">
                                        <label for="birthdate">Data de nascimento</label>
                                        <input type="date" class="form-control" id="birthdate" name="birthdate">
                                    </div>
                                    <div class="form-group col" id="gender_container">
                                        <label for="gender">Gênero</label>
                                        <select id="gender" name="gender" class="form-control">
                                            <option selected disabled>Selecione...</option>
                                            <option>...</option>
                                        </select>
                                    </div>
                                    <div class="form-group col" id="ethnicity_container">
                                        <label for="ethnicity">Etnia</label>
                                        <select id="ethnicity" name="ethnicity" class="form-control">
                                            <option selected disabled>Selecione...</option>
                                            <option>...</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col" id="civil_status_container">
                                        <label for="civil_status">Estado Civil</label>
                                        <select id="civil_status" name="civil_status" class="form-control">
                                            <option selected disabled>Selecione...</option>
                                            <option>...</option>
                                        </select>
                                    </div>
                                    <div class="form-group col" id="scholarity_container">
                                        <label for="scholarity">Escolaridade</label>
                                        <select id="scholarity" name="scholarity" class="form-control">
                                            <option selected disabled>Selecione...</option>
                                            <option>...</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col" id="email_container">
                                        <label for="email">E-mail</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="email@email.com">
                                    </div>
                                    <div class="form-group col" id="password_container">
                                        <label for="password">Senha</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="******">
                                        <small id="passwordHelpInline" class="text-muted">
                                            Minímo de 6 caracteres.
                                        </small>
                                    </div>
                                    <div class="form-group col" id="password_confirmation_container">
                                        <label for="password_confirmation">Confirmação de senha</label>
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="******">
                                    </div>
                                </div>
                            </section>
                            <div align="right" style="margin-top: 5px;">
                                <button type="submit" class="btn btn-success" id="submit_button"><span class="cil-check"></span> Salvar e continuar</button>
                            </div>
                        </form>
                    </div>
                    <div id="address_tab" class="container tab-pane fade"><br>
                        <section>
                            <h3>Endereço</h3>
                            <form id="address_form">
                                <div class="form-row">
                                    <div class="form-group form-inline">
                                        <label for="zip_code" style="margin-right: 5px;">CEP</label>
                                        <input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="99999-999" style="margin-right: 5px;">
                                        <button type="button" class="btn btn-sm btn-pill btn-primary" id="zip_code_button">Buscar</button>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="public_place">Logradouro</label>
                                        <input type="text" class="form-control" id="public_place" name="public_place" placeholder="Av. | Rua">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="place_number">Nº do local</label>
                                        <input type="text" class="form-control" id="place_number" name="place_number" placeholder="Ex.: 1525">
                                    </div>
                                    <div class="form-group col">
                                        <label for="neighborhood">Bairro</label>
                                        <input type="text" class="form-control" id="neighborhood" name="neighborhood" placeholder="Ex.: Infraero II">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="complement">Complemento</label>
                                        <input type="text" class="form-control" id="complement" name="complement" placeholder="Ex.: Próximo ao Mini Box Dias">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="uf">UF</label>
                                        <select id="uf" name="uf" class="form-control">
                                            <option selected disabled>Selecione...</option>
                                            <option>...</option>
                                        </select>
                                    </div>
                                </div>
                                <div align="right" style="margin-top: 5px;">
                                    <button type="submit" class="btn btn-success" id="address_submit_button"><span class="cil-check"></span> Salvar e continuar</button>
                                </div>
                            </form>
                        </section>
                    </div>
                    <div id="phone_tab" class="container tab-pane fade"><br>
                        <section>
                            <h3>Contato</h3>
                            <div id="phones_container">
                                <ul class="list-group" id="phones_list">
                                    <li class="list-group-item">Quisque hendrerit orci</li>
                                </ul>
                                <p>Ainda não há número de telefone cadastrado.</p>
                            </div>
                            <a role="button" href="#" class="btn btn-primary" id="new_phone_button"><span class="cil-plus"></span> Novo número</a>
                        </section>
                    </div>
                    <div id="social_media_tab" class="container tab-pane fade"><br>
                        <section>
                            <h3>Redes sociais</h3>
                            <div id="social_media_container">
                                <p>Ainda não há rede social cadastrada.</p>
                            </div>
                            <a role="button" href="#" class="btn btn-info"><span class="cil-plus"></span> Nova rede social</a>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal base --}}
    <div class="modal fade" id="baseModal" tabindex="-1" role="dialog" aria-labelledby="baseModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="baseModalLabel" id="modal_title"></h5>
                </div>
                <div class="modal-body" id="modal_body">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function deletePhone(phone_id) {
            let login_request = $.ajax({
                headers: {
                    accept: 'application/json',
                    authorization: `Bearer ${user_token}`
                },
                method: "DELETE",
                url: "/api/phones/" + phone_id,
            });

            login_request.done(function( data ) {
                $('#phone_' + phone_id).remove();
            });

            login_request.fail(function( data ) {
                console.log(data);
            });
        }
        $(function() {
            let attributes = [
                'name',
                'social_name',
                'cpf',
                'rg',
                'uf_rg',
                'birthdate',
                'gender',
                'ethnicity',
                'civil_status',
                'scholarity',
                'email',
                'password',
                'password_confirmation'
            ];

            let address_attributes = [
                'zip_code',
                'public_place',
                'place_number',
                'neighborhood',
                'complement',
                'uf'
            ];

            let phone_attributes = [
                'number_phone',
                'type_phone',
                'is_whatsapp'
            ];

            let user_id;

            let user_token = localStorage.getItem('token');

            let spinner_login = `
                <div class="spinner-border spinner-border-sm" role="status">
                  <span class="sr-only">Carregando...</span>
                </div>
            `;

            let uf_options = `
                <option value="AC">Acre</option>
                <option value="AL">Alagoas</option>
                <option value="AP">Amapá</option>
                <option value="AM">Amazonas</option>
                <option value="BA">Bahia</option>
                <option value="CE">Ceará</option>
                <option value="DF">Distrito Federal</option>
                <option value="ES">Espírito Santo</option>
                <option value="GO">Goiás</option>
                <option value="MA">Maranhão</option>
                <option value="MT">Mato Grosso</option>
                <option value="MS">Mato Grosso do Sul</option>
                <option value="MG">Minas Gerais</option>
                <option value="PA">Pará</option>
                <option value="PB">Paraíba</option>
                <option value="PR">Paraná</option>
                <option value="PE">Pernambuco</option>
                <option value="PI">Piauí</option>
                <option value="RJ">Rio de Janeiro</option>
                <option value="RN">Rio Grande do Norte</option>
                <option value="RS">Rio Grande do Sul</option>
                <option value="RO">Rondônia</option>
                <option value="RR">Roraima</option>
                <option value="SC">Santa Catarina</option>
                <option value="SP">São Paulo</option>
                <option value="SE">Sergipe</option>
                <option value="TO">Tocantins</option>
            `;

            let gender_options = `
                <option value=1>Masculino</option>
                <option value=2>Feminino</option>
                <option value=3>Homem transgênero</option>
                <option value=4>Mulher transgênero</option>
                <option value=5>Homem transexual</option>
                <option value=6>Mulher transexual</option>
                <option value=7>Cisgênero</option>
                <option value=8>Não sei responder</option>
                <option value=9>Prefiro não responder</option>
                <option value=10>Outros</option>
            `;

            let ethnicity_options = `
                <option value=1>Amarelo</option>
                <option value=2>Branco</option>
                <option value=3>Indígena</option>
                <option value=4>Pardo</option>
                <option value=5>Preto</option>
            `;

            let civil_status_options = `
                <option value="0">Solteiro(a)</option>
                <option value="1">Casado(a)</option>
                <option value="2">Separado(a)</option>
                <option value="3">Divorciado(a)</option>
                <option value="4">Viúvo(a)</option>
                <option value="5">Amasiado(a)</option>
            `;

            let scholarity_options = `
                <option value="1">Ensino fundamental incompleto</option>
                <option value="2">Ensino fundamental completo</option>
                <option value="3">Ensino médio incompleto</option>
                <option value="4">Ensino médio completo</option>
                <option value="5">Ensino médio integrado ao nível técnico incompleto</option>
                <option value="6">Ensino médio integrado ao nível técnico completo</option>
                <option value="7">Nível técnico incompleto</option>
                <option value="8">Nível técnico completo</option>
                <option value="9">Nível superior incompleto</option>
                <option value="10">Nível superior completo</option>
            `;

            $('#uf_rg').append(uf_options);
            $('#uf').append(uf_options);
            $('#gender').append(gender_options);
            $('#ethnicity').append(ethnicity_options);
            $('#civil_status').append(civil_status_options);
            $('#scholarity').append(scholarity_options);

            // Mascáras
            $('#cpf').mask('000.000.000-00');
            $('#zip_code').mask('00000-000');

            $('#zip_code_button').click(() => {
                $('#zip_code_button').html(spinner_login);
                $("#zip_code_button").attr("disabled", "disabled");

                let cep = $('#zip_code').val();

                let login_request = $.ajax({
                    headers: {
                        accept: 'application/json',
                        authorization: `Bearer ${user_token}`
                    },
                    method: "POST",
                    url: "/api/cep",
                    data: {
                        cep: cep,
                    },
                });

                login_request.done(function( data ) {
                    console.log(data);
                    $("#zip_code_button").removeAttr("disabled", "disabled");
                    $('#zip_code_button').text('Buscar');

                    $('#public_place').val(data.logradouro);
                    $('#neighborhood').val(data.localidade);
                    $('#uf').val(data.uf);

                });

                login_request.fail(function( data ) {
                    $("#zip_code_button").removeAttr("disabled", "disabled");
                    $('#zip_code_button').text('Buscar');
                    console.log(data);
                });
            });

            $('#new_phone_button').click(() => {
                $('#modal_body').html(`
                    <form id="phone_form">
                        <div class="form-group">
                            <label for="number_phone">Número</label>
                            <input type="text" class="form-control" id="number_phone" name="number_phone" placeholder="(96) 98888-8888">
                        </div>
                        <div class="form-group">
                            <label for="type_phone">Tipo</label>
                            <input type="text" class="form-control" id="type_phone" name="type_phone" placeholder="Ex.: Recado">
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="1" id="is_whatsapp" name="is_whatsapp">
                          <label class="form-check-label" for="is_whatsapp">
                            WhatsApp
                          </label>
                        </div>
                        <div align="right" style="margin-top: 5px;">
                            <button type="submit" class="btn btn-success" id="phone_submit_button"><span class="cil-check"></span> Salvar</button>
                        </div>
                    </form>
                `);
                $('#number_phone').mask('(99) 99999-9999');
                $('#phone_form').submit((e) => {
                    e.preventDefault();

                    let data = new FormData(e.target);
                    let info = Object.fromEntries(data.entries());

                    info = {...info, user_id: user_id};

                    $('#phone_submit_button').html(spinner_login);
                    $("#phone_submit_button").attr("disabled", "disabled");

                    phone_attributes.forEach(element => {
                        $(`#invalid-feedback-${element}`).remove();
                        $(`#${element}`).removeClass('is-invalid');
                    });

                    let login_request = $.ajax({
                        headers: {
                            accept: 'application/json',
                            authorization: `Bearer ${user_token}`
                        },
                        method: "POST",
                        url: "/api/phones",
                        data: info,
                    });

                    login_request.done(function( data ) {
                        $('#phone_submit_button').text('Salvar');
                        $("#phone_submit_button").removeAttr("disabled", "disabled");
                        $('#phones_list').append(`
                            <li class="list-group-item" id="phone_${data.data.id}">
                                ${data.data.number_phone} - ${data.data.type_phone} - ${data.data.is_whatsapp} (<button onclick="deletePhone(${data.data.id})">Remover</button>)
                            </li>
                        `);
                        $('#baseModal').modal('hide');
                    });

                    login_request.fail(function( data ) {
                        for (var key in data.responseJSON.data) {
                            phone_attributes.forEach(element => {
                                if(key == element) {
                                    $(`#${element}`).addClass('is-invalid');
                                    $(`#${element}_container`).append(`
                            <div class="invalid-feedback" id="invalid-feedback-${element}">
                                ${data.responseJSON.data[element]}
                            </div>`);
                                }
                            });
                        }
                        $('#phone_submit_button').text('Salvar');
                        $("#phone_submit_button").removeAttr("disabled", "disabled");

                    });
                });
                $('#baseModal').modal('show');
            });

            $('#new_user_form').submit((e) => {
                e.preventDefault();
                const data = new FormData(e.target);
                const info = Object.fromEntries(data.entries());

                $('#submit_button').html(spinner_login);
                $("#submit_button").attr("disabled", "disabled");

                attributes.forEach(element => {
                    $(`#invalid-feedback-${element}`).remove();
                    $(`#${element}`).removeClass('is-invalid');
                });

                let login_request = $.ajax({
                    headers: {
                        accept: 'application/json',
                        authorization: `Bearer ${user_token}`
                    },
                    method: "POST",
                    url: "/api/users",
                    data: info,
                });

                login_request.done(function( data ) {
                    $('#submit_button').text('Salvar e continuar');
                    $("#submit_button").removeAttr("disabled", "disabled");
                    $('#address_tab_link').tab('show');
                    $('#user_tab_link').addClass('disabled');
                    user_id = data.data.id;

                    Swal.fire({
                        title: 'Sucesso!',
                        text: 'Usuário registrado.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    })
                });

                login_request.fail(function( data ) {
                    for (var key in data.responseJSON.data) {
                        attributes.forEach(element => {
                            if(key == element) {
                                $(`#${element}`).addClass('is-invalid');
                                $(`#${element}_container`).append(`
                            <div class="invalid-feedback" id="invalid-feedback-${element}">
                                ${data.responseJSON.data[element]}
                            </div>`);
                            }
                        });
                    }
                    $('#submit_button').text('Salvar e continuar');
                    $("#submit_button").removeAttr("disabled", "disabled");

                });
            });

            $('#social_name_check').click(function(){
                if($(this).is(":checked")){
                    $('#social_name').attr('disabled', 'disabled');
                } else {
                    $('#social_name').removeAttr('disabled', 'disabled');
                }
            });

            $('#address_form').submit((e) => {
                e.preventDefault();

                let data = new FormData(e.target);
                let info = Object.fromEntries(data.entries());

                info = {...info, user_id: user_id};

                $('#address_submit_button').html(spinner_login);
                $("#address_submit_button").attr("disabled", "disabled");

                address_attributes.forEach(element => {
                    $(`#invalid-feedback-${element}`).remove();
                    $(`#${element}`).removeClass('is-invalid');
                });

                let login_request = $.ajax({
                    headers: {
                        accept: 'application/json',
                        authorization: `Bearer ${user_token}`
                    },
                    method: "POST",
                    url: "/api/addresses",
                    data: info,
                });

                login_request.done(function( data ) {
                    $('#address_submit_button').text('Salvar e continuar');
                    $("#address_submit_button").removeAttr("disabled", "disabled");
                    $('#phone_tab_link').tab('show');
                    $('#address_tab_link').addClass('disabled');

                    Swal.fire({
                        title: 'Sucesso!',
                        text: 'Endereço registrado.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    })
                });

                login_request.fail(function( data ) {
                    for (var key in data.responseJSON.data) {
                        address_attributes.forEach(element => {
                            if(key == element) {
                                $(`#${element}`).addClass('is-invalid');
                                $(`#${element}_container`).append(`
                            <div class="invalid-feedback" id="invalid-feedback-${element}">
                                ${data.responseJSON.data[element]}
                            </div>`);
                            }
                        });
                    }
                    $('#address_submit_button').text('Salvar e continuar');
                    $("#address_submit_button").removeAttr("disabled", "disabled");

                });
            });



        });
    </script>
@endsection
