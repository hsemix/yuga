<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Byakuno | Wewandiise</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo  assets('css/bootstrap/css/bootstrap.min.css') ; ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo  assets('fonts/css/font-awesome.min.css') ; ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo  assets('fonts/ionicons.min.css') ; ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo  assets('css/dist/css/AdminLTE.min.css') ; ?>">
  <link rel="stylesheet" href="<?php echo  assets('css/dist/css/skins/_all-skins.min.css') ; ?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo  assets('css/plugins/iCheck/square/blue.css') ; ?>">
  <link rel="stylesheet" href="<?php echo  assets('css/byakuno.css') ; ?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="register-page hold-transition skin-blue layout-top-nav" style="background: black url(<?php echo  assets('img/index1.jpg') ; ?>);background-size: cover;background-size: 80%;">
  
    <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="" class="navbar-brand"><b><img src="<?php echo  assets('icon/perfectlogobluesmall.png') ; ?>" width="20"/>yakuno</b>Ttabamiruka</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <div class="col-sm-12">
      <div class="col-sm-6"></div>
      <div class="col-sm-6">
        
        <div class="login-box">
          
          <!-- /.login-logo -->
          <div class="login-box-body">
            <p class="login-box-msg">Yingira Olabe Ebisingawo!!!</p>

            <form action="<?php echo  route('login') ; ?>" method="post" class="byakuno-form-files">
              <div class="form-group has-feedback<?php echo  $errors->has('login_username')?' has-error':'' ; ?>">
                <input type="text" name="login_username" class="form-control" placeholder="Email" value="<?php echo  $request->old('login_username')?:'' ; ?>">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                <?php if($errors->has('login_username')): ?>
                  <span class="help-block"><?php echo  $errors->first('login_username') ; ?></span>
                <?php endif; ?>
              </div>
              <div class="form-group has-feedback<?php echo  $errors->has('login_password')?' has-error':'' ; ?>">
                <input type="password" name="login_password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                <?php if($errors->has('login_password')): ?>
                  <span class="help-block"><?php echo  $errors->first('login_password') ; ?></span>
                <?php endif; ?>

                
              </div>
              <div class="row">
                <div class="col-xs-8">
                  <div class="checkbox icheck">
                    <label>
                      <input type="checkbox"> Nkumira Munda
                    </label>
                  </div>
                </div>
                <input type="hidden" name="_token" value="<?php echo  csrf_token() ; ?>" />
                <!-- /.col -->
                <div class="col-xs-4">
                  <button type="submit" class="btn btn-primary btn-block btn-flat">Yingira</button>
                </div>
                <!-- /.col -->
              </div>
              <div class="alert alert-danger hidden">Error:</div>
            </form>

           
            <!-- /.social-auth-links -->

            <a href="#">Werabidde Password Yo?</a><br>
            <!--a href="register.html" class="text-center">Register a new membership</a-->

          </div>
          <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->


        <div class="register-box">
         
          <div class="register-box-body">
            <p class="login-box-msg">Wewandiise</p>

            <form action="<?php echo  route('register') ; ?>" method="post" class="byakuno-form-files">
              <div class="form-group has-feedback<?php echo  $errors->has('fullname')?' has-error':'' ; ?>">
                <input type="text" name="fullname" class="form-control" placeholder="Full name" value="<?php echo  $request->old('fullname')?:'' ; ?>">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                <?php if($errors->has('fullname')): ?>
                  <span class="help-block"><?php echo  $errors->first('fullname') ; ?></span>
                <?php endif; ?>
              </div>
              <div class="form-group has-feedback<?php echo  $errors->has('email')?' has-error':'' ; ?>">
                <input type="text" name="email" class="form-control" placeholder="Email"  value="<?php echo  $request->old('email')?:'' ; ?>">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                <?php if($errors->has('email')): ?>
                  <span class="help-block"><?php echo  $errors->first('email') ; ?></span>
                <?php endif; ?>
              </div>
              <div class="form-group has-feedback<?php echo  $errors->has('phone_number')?' has-error':'' ; ?>">
                <input type="text" name="phone_number" class="form-control" placeholder="Phone"  value="<?php echo  $request->old('phone_number')?:'' ; ?>">
                <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                <?php if($errors->has('phone_number')): ?>
                  <span class="help-block"><?php echo  $errors->first('phone_number') ; ?></span>
                <?php endif; ?>
              </div>
              <div class="form-group has-feedback<?php echo  $errors->has('username')?' has-error':'' ; ?>">
                <input type="text" name="username" class="form-control" placeholder="Username"  value="<?php echo  $request->old('username')?:'' ; ?>">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                <?php if($errors->has('username')): ?>
                  <span class="help-block"><?php echo  $errors->first('username') ; ?></span>
                <?php endif; ?>
              </div>
              <div class="form-group has-feedback<?php echo  $errors->has('password')?' has-error':'' ; ?>">
                <input type="password" name="password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                <?php if($errors->has('password')): ?>
                  <span class="help-block"><?php echo  $errors->first('password') ; ?></span>
                <?php endif; ?>
              </div>
              <div class="form-group has-feedback<?php echo  $errors->has('password_confirmation')?' has-error':'' ; ?>">
                <input type="password" name="password_confirmation" class="form-control" placeholder="Retype password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                <?php if($errors->has('password_confirmation')): ?>
                  <span class="help-block"><?php echo  $errors->first('password_confirmation') ; ?></span>
                <?php endif; ?>
              </div>
              <div class="row">
                <div class="col-xs-12 col-md-6 col-sm-6">
                  <div class="checkbox icheck">
                    <label>
                      <input type="checkbox"> Nzikirizza <a href="#">enkola n'obukwakulizo</a>
                    </label>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-12 col-md-6 col-sm-6">
                  <button type="submit" class="btn btn-primary btn-block btn-flat">Wewandiise</button>
                </div>

                <input type="hidden" name="_token" value="<?php echo  csrf_token() ; ?>" />
                <!-- /.col -->
              </div>
              <div class="alert alert-danger hide">Error:</div>
            </form>

            

            <!--a href="login.html" class="text-center">I already have a membership</a-->
          </div>
          <!-- /.form-box -->
        </div>

        <!-- /.register-box -->
      </div>
</div>

<!-- jQuery 2.2.3 -->
<script src="<?php echo  assets('css/plugins/jQuery/jquery-2.2.3.min.js') ; ?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo  assets('css/bootstrap/js/bootstrap.min.js') ; ?>"></script>
<!-- iCheck -->
<script src="<?php echo  assets('css/plugins/iCheck/icheck.min.js') ; ?>"></script>
<script src="<?php echo  assets('js/jquery-ajax-form.js') ; ?>"></script>
<script src="<?php echo  assets('js/byakuno-ajax.js') ; ?>"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>

</body>
</html>
