@extends('welcome')

@section('head')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">

@endsection

@section('content')

    <!-- ============================================================== -->
    <!-- Início modal cadastra cliente -->
    <!-- ============================================================== -->
    <!-- The Modal -->
    <div class="modal fade" id="addCustomerModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Cadastro de novo cliente</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <form id="form-add-customer">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div id="upload-demo" style="margin-top: 5px;"></div>
                            </div>
                            <div class="col-md-4" style="padding:5%;">
                                <strong>Selecione uma foto:</strong>
                                <input type="file" id="image">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group required">
                                    <label class="control-label">Nome</label>
                                    <input type="text" class="form-control" name="name" id="name" required="required">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="control-label">E-mail</label>
                                    <input type="email" class="form-control" name="email" id="email" required="required">
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Telefone</label>
                                    <input type="tel" class="form-control" name="phone" id="phone">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" id="submit" class="btn btn-info"><i class="fa fa-plus"></i> Cadastrar cliente</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Fim modal cadastra cliente -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- Início modal deleta cliente -->
    <!-- ============================================================== -->
    <div class="modal fade" id="delete-customer-modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Excluir cliente</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group required">
                                <i class="fa fa-exclamation-triangle fa-3x" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <div class="form-group required">
                                Tem certeza que deseja excluir este cliente?<br>Esta operação é irreversível!
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Fechar</button>
                    <button id="delete-customer" type="button" class="btn btn-danger"><i class="fa fa-minus"></i> Excluir cliente</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Início modal deleta cliente -->
    <!-- ============================================================== -->



    <!-- ============================================================== -->
    <!-- Início modal mensagem -->
    <!-- ============================================================== -->
    <div class="modal fade" id="modal-notice">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="title-message"></h4>
                </div>
                <div class="modal-body">
                    <table class="table-responsive">
                        <tr style="vertical-align: center">
                            <td style="padding: 10px">
                                <i id="icon" aria-hidden="true"></i>
                            </td>
                            <td>
                                <h4 id="success-message"></h4>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Fim modal mensagem -->
    <!-- ============================================================== -->

    <div class="row ">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row" style="margin-bottom: -14px">
                        <div class='col-sm-3'>
                            <div class="form-group">
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addCustomerModal"><i class="fa fa-plus" aria-hidden="true"></i> Cadastrar novo cliente</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="material-card card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="customer_datatable" class="table table-striped border display" style="width: 100%">
                            <thead>
                            <tr>
                                <th>Cód.</th>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Telefone</th>
                                <th>Ação</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Cód.</th>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Telefone</th>
                                <th>Ação</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>

    <script>
        $.ajaxSetup({

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var resize = $('#upload-demo').croppie({
            enableExif: true,
            enableOrientation: true,
            viewport: {
                width: 200,
                height: 200,
                type: 'circle'
            },

            boundary: {
                width: 210,
                height: 210
            }
        });

        $('#image').on('change', function () {
            var reader = new FileReader();

            reader.onload = function (e) {
                resize.croppie('bind',{
                    url: e.target.result
                }).then(function(){
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
        });

        $('#submit').on('click', function (ev) {
            resize.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (img) {
                $.ajax({
                    url: "/customer",
                    type: "POST",
                    data: {"photo":img,
                        "_token": "{{ csrf_token() }}",
                        "image":$("#image").val(),
                        "name":$("#name").val(),
                        "email":$("#email").val(),
                        "phone":$("#phone").val(),
                    },

                    success: function (response) {
                        //reload do datatable
                        $('#customer_datatable').DataTable().ajax.reload();
                        $("#addCustomerModal").modal('toggle');

                        $("#success-message").html(response.message);
                        $("#title-message").html(response.title);
                        $("#icon").attr('class', response.class_icon);
                        $("#modal-notice").modal('show');
                        setTimeout(
                            function () {
                                $("#modal-notice").modal('hide');
                            }, 3000);
                    }
                });
            });
        });

    </script>

    <script>
        $('#customer_datatable').DataTable({
            ajax: {
                type: "GET",
                url: "{!! route('customers.get.all') !!}"
            },
            deferRender: true,
            aoColumns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'email' },
                { data: 'phone' },

                /* EDIT */ {
                    mRender: function (data, type, row) {
                        return '<div class="btn-group">\n' +
                            '       <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">\n' +
                            '           Ação <span class="caret"></span> <span class="sr-only">Toggle Dropdown</span>\n' +
                            '       </button>\n' +
                            '       <ul class="dropdown-menu" role="menu">\n' +
                            '           <li style="padding: 5px"><a href="/customer/' + row['id'] + '" title="Visualizar cliente" class="" role="button"><i class="fas fa-search-plus" aria-hidden="true"></i> Visualizar cliente</a></li>' +
                            '           <li style="padding: 5px"><a href="javascript:void(0)" onclick="deleteCustomer(' + row['id'] + ')" title="Excluir cliente" class="" role="button"><i class="far fa-trash-alt" aria-hidden="true"></i> Excluir cliente</a></li>'
                            '       </ul>\n' +
                            '   </div>'
                    }
                },
            ],
            dom: 'Bfrtip',
            "language": {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sLengthMenu": "_MENU_ Resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "sUrl": "",
                "sInfoDecimal": ",",
                "sInfoThousands": ".",
                "oPaginate":
                    {
                        "sNext": "Próximo",
                        "sPrevious": "Anterior",
                        "sFirst": "Primeiro",
                        "sLast": "Último"
                    },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            }
        });

        $('#delete-customer').click(function () {

            var customerId = $("#delete-customer").attr("data-customerid");
            $.ajax({
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                cache: false,
                type: 'DELETE',
                url: '/customer/'+ customerId,
                success: function (data) {
                    $("#delete-customer-modal").modal('toggle');
                    $("#success-message").html(data.message);
                    $("#title-message").html(data.title);
                    $("#icon").attr('class', data.class_icon);
                    //reload do datatable
                    $('#customer_datatable').DataTable().ajax.reload();
                    //preciso dar o tempo de no mínimo 400ms antes de mostrar a modal notice
                    //para dar tempo de fechar completamente a modal anterior
                    setTimeout(
                        function () {
                            $("#modal-notice").modal('show');
                        }, 400);
                    setTimeout(
                        function () {
                            $("#modal-notice").modal('hide');
                        }, 3000);
                }
            });
        });

        function deleteCustomer(id){
            $("#delete-customer" ).attr( "data-customerid", id );
            $("#delete-customer-modal").modal('show');
        }

    </script>
@endsection
