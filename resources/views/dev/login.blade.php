<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Cyber8Lab | Admin Log in</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('assets/bower_components/font-awesome/cs')}}s/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{ asset('assets/bower_components/Ionicons/css/ionicons.min.css')}}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('assets/dist/css/AdminLTE.min.css')}}">
        <!-- iCheck -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/iCheck/square/blue.css')}}">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-box-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form id="login-form" action="{{route('dev.login') }}" method="post">
                    @csrf
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Email" name="password" value="11111111">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Password" name="email" value="amit@admin.com">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        <div class="form-group has-error">
                            <span id="password-error" class="help-block">{{$errors->has('password') ?  $errors->first('password') : null}}</span>
                            <span id="login-error" class="help-block">{{session()->get('error')}}</span>
                        </div>

                        <div id="reset-password"  style="display:none;cursor: pointer;">
                            <a class="text-aqua" data-toggle="modal" data-target="#modal-default">Forgot password?</a>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-xs-4">
                            <button id="login-btn" type="submit" class="btn btn-primary btn-block btn-flat">Sign in</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->

        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-center">Reset your password</h4>
                    </div>
                    <div class="modal-body text-center">
                        <form class="form-horizontal" id="reset-password-form" method="post" action="#">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <input name="email" type="email" class="form-control" id="inputEmail3" placeholder="Email" required>
                                        <p class="help-block">Please check your admin account email and we will send the OTP for resetting your password</p>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button id="reset-password-btn" type="submit" class="btn btn-info">Submit</button>
                            </div>
                            <!-- /.box-footer -->
                        </form>
                    </div>
                    
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>


        <div class="modal fade" id="otp-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body text-center">
                        <form class="form-horizontal" id="submit-otp-form" method="post" action="#">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">OTP</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="otp" class="form-control" id="otp" placeholder="Enter the OTP sent to your email" required>
                                        <input id="hidden_user_id" type="hidden" name="user_id">
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button id="submit-otp-btn" type="submit" class="btn btn-info">Submit</button>
                            </div>
                            <!-- /.box-footer -->
                        </form>
                    </div>
                    
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <div class="modal fade" id="reset-password-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body text-center">
                        <div class="box-body">
                            <form class="form-horizontal" id="confirm-reset-password-form" method="post" action="#">
                            @csrf
                            <input type="hidden" id="res_pass_hidden_user_id" name="user_id">
                                <div class="form-group">
                                    <label for="res-password">Password</label>
                                    <input type="password" name="password" class="form-control" id="res-password" placeholder="Enter new password" minlength="8">
                                </div>
                                <div class="form-group">
                                    <label for="conf-res-password">Confirm Password</label>
                                    <input type="password" name="conf_password" class="form-control" id="conf-res-password" placeholder="Retype the password" minlength="8">
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button id="reset-confirm-password-btn" type="submit" class="btn btn-info">Submit</button>
                                </div>
                                <!-- /.box-footer -->
                            </form>
                        </div>
                    </div>
                    
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>


        <!-- jQuery 3 -->
        <script src="{{ asset('admin/bower_components/jquery/dist/jquery.min.js')}}"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="{{ asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <!-- iCheck -->
        <script src="{{ asset('admin/plugins/iCheck/icheck.min.js')}}"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            $(function () {
              $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' /* optional */
              });
            });

            var attempt = 0;

            $('#login-form').on('submit', function(e) {

                $('#email-error').html('');
                $('#password-error').html('');
                $('#login-error').html('');
                $('#login-btn').html('<i class="fa fa-spin fa-refresh"></i>&nbsp;&nbsp;Verifying....');
                $('#login-btn').attr('disabled' , true);
                e.preventDefault();
                var form = $(this);
                var url = form.attr('action');
                var data = form.serialize();

                $.ajax({
                    method: form.attr('method'),
                    url:url,
                    data:data,
                    success: function (data) {
                        if(data.error == false){
                            //console.log(data);
                            window.localStorage.setItem('bearer_token', data.token);
                            window.location.href = data.redirect;
                            
                        } else {
                            attempt++
                            $('#email-error').html('');
                            $('#password-error').html('');
                            $('#login-error').html('');
                            if(data.email) {
                                $('#email-error').html(data.email[0]);
                            }

                            if(data.password) {
                                $('#password-error').html(data.password[0]);
                            }
                            
                            $('#login-error').html(data.message);
                            console.log(data)
                        }

                        $('#login-btn').html('Sign In');
                        $('#login-btn').attr('disabled' , false);
                        console.log(attempt);
                        if(attempt > 2) {
                            $('#reset-password').show();
                        }
                    }
                });
            });

            $('#reset-password-form').on('submit', function(e) {
                e.preventDefault();

                $('#reset-password-btn').prop("disabled", true);

                var form = $(this);
                var url = form.attr('action');
                var data = form.serialize();

                $.ajax({
                    method: form.attr('method'),
                    url:url,
                    data:data,
                    success: function (data) {
                        if(!data.error){
                            
                            $("#modal-default").modal('hide'); 

                            $('#otp-modal').modal('show');

                            $('#hidden_user_id').val(data.id);
                            $('#res_pass_hidden_user_id').val(data.id);

                        } else {  
                            swal({
                                title: "",
                                text: data.message,
                                icon: "error",
                                closeModal: true,
                                buttons: {
                                    cancel: false,
                                    ok:true
                                },          
                            }); 
                        }

                        $('#reset-password-btn').prop("disabled", false);
                    }
                });
            });

            $('#submit-otp-form').on('submit', function(e) {
                e.preventDefault();

                $('#submit-otp-btn').prop("disabled", true);

                var form = $(this);
                var url = form.attr('action');
                var data = form.serialize();

                $.ajax({
                    method: form.attr('method'),
                    url:url,
                    data:data,
                    success: function (data) {
                        if(!data.error){
                            
                            $("#otp-modal").modal('hide'); 

                            $('#reset-password-modal').modal('show');

                        } else {  
                            swal({
                                title: "",
                                text: data.message,
                                icon: "error",
                                closeModal: true,
                                buttons: {
                                    cancel: false,
                                    ok:true
                                },          
                            }); 
                        }

                        $('#submit-otp-btn').prop("disabled", false);
                    }
                });
            });

            $('#confirm-reset-password-form').on('submit', function(e) {
                e.preventDefault();

                $('#reset-confirm-password-btn').prop("disabled", true);

                var form = $(this);
                var url = form.attr('action');
                var data = form.serialize();

                $.ajax({
                    method: form.attr('method'),
                    url:url,
                    data:data,
                    success: function (data) {
                        if(!data.error){
                            
                            $('#reset-password-modal').modal('hide');

                            swal({
                                title: "",
                                text: data.message,
                                icon: "success",

                                closeModal: true,
                                buttons: {
                                    cancel: false,
                                    ok:true
                                },
                            })
                            .then((value) => {
                                location.reload();
                            });

                        } else {  
                            swal({
                                title: "",
                                text: data.message,
                                icon: "error",
                                closeModal: true,
                                buttons: {
                                    cancel: false,
                                    ok:true
                                },          
                            }); 
                        }

                        $('#reset-confirm-password-btn').prop("disabled", false);
                    }
                });
            })

        </script>
    </body>
</html>