@extends('welcome')

@section('head')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">

@endsection

@section('content')

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
                                        <input type="text" class="form-control" name="name" id="name" value="{{ $customer->name }}" required="required">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label">E-mail</label>
                                        <input type="email" class="form-control" name="email" id="email" value="{{ $customer->email }}" required="required">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Telefone</label>
                                        <input type="tel" class="form-control" name="phone" id="phone" value="{{ $customer->phone }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" id="submit" class="btn btn-info"><i class="fa fa-plus"></i> Alterar cliente</button>
                        </div>
                    </form>

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
            },

        });

        if( '{!! $customer->photo !!}' == '' ){
            resize.croppie('bind', {
                url: '{!! asset('images/no_image_user.jpg') !!}',
            });
        } else {
            resize.croppie('bind', {
                url: '{!! asset('storage/'.$customer->photo) !!}',
            });
        }

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
                    url: "/customer/{{ $customer->id }}",
                    type: "PUT",
                    data: {"photo":img,
                        "_token": "{{ csrf_token() }}",
                        "image":$("#image").val(),
                        "name":$("#name").val(),
                        "email":$("#email").val(),
                        "phone":$("#phone").val(),
                    },

                    success: function (response) {
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
@endsection
