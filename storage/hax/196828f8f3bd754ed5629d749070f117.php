<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Byakuno | <?php echo  $user->fullname ; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="token" content = "<?php echo  csrf_token() ; ?>" id="token" >
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo  assets('css/bootstrap/css/bootstrap.min.css') ; ?>">
  <link rel="stylesheet" href="<?php echo  assets('css/plugins/datepicker/datepicker3.css') ; ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo  assets('fonts/css/font-awesome.min.css') ; ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo  assets('fonts/ionicons.min.css') ; ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo  assets('css/dist/css/AdminLTE.min.css') ; ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo  assets('css/dist/css/skins/_all-skins.min.css') ; ?>">
  <link rel="stylesheet" href="<?php echo  assets('css/byakuno.css') ; ?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue fixed layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header pull-left">
          
          
            <a href="<?php echo  route('home') ; ?>" class="navbar-brand"><b><img src="<?php echo  assets('icon/perfectlogobluesmall.png') ; ?>" width="20"/>yakuno</b>Ttabamiruka</a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
              <i class="fa fa-bars"></i>
            </button>
          
          
            
          
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          
          <form class="navbar-form navbar-left col-sm-12" role="search">
            <div class="form-group">
              <input type="text" class="form-control" onkeyup="$byakuno.Header.search(this);" style="width:500px;" id="navbar-search-input" placeholder="Noonya byonna byoyagala...">
              <ul class="dropdown-menu suggestions" style="display:none;width:500px">
              </ul>
            </div>
            
          </form>

        </div>
        <?php if($errors->has('fullname')): ?>
                  <span class="help-block"><?php echo  $errors->first('fullname') ; ?></span>
                <?php endif; ?>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->
            <li class="dropdown messages-menu">
              <!-- Menu toggle button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-envelope-o"></i>
                <span class="label label-success">4</span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">You have 4 messages</li>
                <li>
                  <!-- inner menu: contains the messages -->
                  <ul class="menu">
                    <li><!-- start message -->
                      <a href="#">
                        <div class="pull-left">
                          <!-- User Image -->
                          <img src="css/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                        </div>
                        <!-- Message title and timestamp -->
                        <h4>
                          Support Team
                          <small><i class="fa fa-clock-o"></i> 5 mins</small>
                        </h4>
                        <!-- The message -->
                        <p>Why not buy a new awesome theme?</p>
                      </a>
                    </li>
                    <!-- end message -->
                  </ul>
                  <!-- /.menu -->
                </li>
                <li class="footer"><a href="#">See All Messages</a></li>
              </ul>
            </li>
            <!-- /.messages-menu -->

            <!-- Notifications Menu -->
            <li class="dropdown notifications-menu">
              <!-- Menu toggle button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-bell-o"></i>
                <span class="label label-warning">10</span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">You have 10 notifications</li>
                <li>
                  <!-- Inner Menu: contains the notifications -->
                  <ul class="menu">
                    <li><!-- start notification -->
                      <a href="#">
                        <i class="fa fa-users text-aqua"></i> 5 new members joined today
                      </a>
                    </li>
                    <!-- end notification -->
                  </ul>
                </li>
                <li class="footer"><a href="#">View all</a></li>
              </ul>
            </li>
            <!-- Tasks Menu -->
            <li class="dropdown tasks-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-flag-o"></i>
                <span class="label label-danger">9</span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">You have 9 tasks</li>
                <li>
                  <!-- Inner menu: contains the tasks -->
                  <ul class="menu">
                    <li><!-- Task item -->
                      <a href="#">
                        <!-- Task title and progress text -->
                        <h3>
                          Design some buttons
                          <small class="pull-right">20%</small>
                        </h3>
                        <!-- The progress bar -->
                        <div class="progress xs">
                          <!-- Change the css width attribute to simulate progress -->
                          <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                            <span class="sr-only">20% Complete</span>
                          </div>
                        </div>
                      </a>
                    </li>
                    <!-- end task item -->
                  </ul>
                </li>
                <li class="footer">
                  <a href="#">View all tasks</a>
                </li>
              </ul>
            </li>
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="<?php echo  $user->avatar() ; ?>" class="user-image" alt="<?php echo  $user->fullname ; ?>">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs"><?php echo  $user->fullname ; ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="<?php echo  $user->avatar() ; ?>" class="img-circle" alt="<?php echo  $user->fullname ; ?>">

                  <p>
                    <?php echo  $user->fullname ; ?> - <?php echo  ($user->ensibuko)?$user->ensibuko->omuziro:"" ; ?>
                    <small><?php echo  $user->date() ; ?></small>
                  </p>
                </li>
                <!-- Menu Body -->
                <li class="user-body">
                  <div class="row">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </div>
                  <!-- /.row -->
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="<?php echo  route('logout') ; ?>" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <?php $this->emptySection ('page_content'); ?>
  <section class="col-sm-3 chat-holder pull-right chat-container" style="bottom:-20px;right:25%;position:fixed">
    <div class="box box-primary direct-chat direct-chat-primary with-border chat-wrapper" style="display:none;">
        <section class="box-header with-border hide-chat-box">
          <h3 class="box-title chat-recipient-name"></h3>

          <div class="box-tools pull-right">
            <span data-toggle="tooltip" title="3 New Messages" class="badge bg-light-blue">3</span>
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool open-contacts-box" data-toggle="tooltip" title="Emikwano jo">
              <i class="fa fa-comments"></i></button>
            <button type="button" class="btn btn-box-tool" id="close-chat" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </section>
        <!-- /.box-header -->
        <section class="box-body">
          <!-- Conversations are loaded here -->
          <div class="direct-chat-messages chat-messages-container">
            
          </div>
          <!--/.direct-chat-messages-->
        </section>
        <!-- /.box-body -->
        <div class="box-footer">
          <div class="input-group chat-input">
            <input name="message" placeholder="Wandiika Obubaka bwo ..." class="form-control" type="text" />
            <span class="input-group-btn">
              <button type="button" class="btn btn-primary btn-flat" onclick="javascript:$('.chat-emoticons-wrapper').toggle();"><i class="fa fa-smile-o"></i></button>
            </span>

            <div class="chat-emoticons-wrapper" style="position:absolute;z-index:99;margin-left:-155px;margin-top:-65px;background:#fff;display:none;">
              <img src="<?php echo  assets('images/thinking.png') ; ?>" onclick="$byakuno.AddEmoToChat(':/');" width="16px">
              <img src="<?php echo  assets('images/angel.png') ; ?>" onclick="$byakuno.AddEmoToChat('0:)');" width="16px">
              <img src="<?php echo  assets('images/smile.png') ; ?>" onclick="$byakuno.AddEmoToChat(':)');" width="16px">
              <img src="<?php echo  assets('images/smile-big.png') ; ?>" onclick="$byakuno.AddEmoToChat(':D');" width="16px">
              <img src="<?php echo  assets('images/sad.png') ; ?>" onclick="$byakuno.AddEmoToChat(':(');" width="16px">
              <img src="<?php echo  assets('images/crying.png') ; ?>" onclick="$byakuno.AddEmoToChat(':(');" width="16px">
              <img src="<?php echo  assets('images/tongue.png') ; ?>" onclick="$byakuno.AddEmoToChat(':p');" width="16px">
              <img src="<?php echo  assets('images/party.png') ; ?>" onclick="$byakuno.AddEmoToChat('<:o)');" width="16px">
              <img src="<?php echo  assets('images/shocked.png') ; ?>" onclick="$byakuno.AddEmoToChat(':o');" width="16px">
              <img src="<?php echo  assets('images/angry.png') ; ?>" onclick="$byakuno.AddEmoToChat(':@');" width="16px">
              <img src="<?php echo  assets('images/confused.png') ; ?>" onclick="$byakuno.AddEmoToChat(':s');" width="16px">
              <img src="<?php echo  assets('images/wink.png') ; ?>" onclick="$byakuno.AddEmoToChat(';)');" width="16px">
              <img src="<?php echo  assets('images/embarrassed.png') ; ?>" onclick="$byakuno.AddEmoToChat(':$');" width="16px">
              <img src="<?php echo  assets('images/disappointed.png') ; ?>" onclick="$byakuno.AddEmoToChat(':|');" width="16px">
              <img src="<?php echo  assets('images/sick.png') ; ?>" onclick="$byakuno.AddEmoToChat('+o(');" width="16px">
              <img src="<?php echo  assets('images/shut-mouth.png') ; ?>" onclick="$byakuno.AddEmoToChat(':#');" width="16px">
              <img src="<?php echo  assets('images/sleepy.png') ; ?>" onclick="$byakuno.AddEmoToChat('|)');" width="16px">
              <img src="<?php echo  assets('images/eyeroll.png') ; ?>" onclick="$byakuno.AddEmoToChat('8)');" width="16px">
              <img src="<?php echo  assets('images/glasses-nerdy.png') ; ?>" onclick="$byakuno.AddEmoToChat('8|');" width="16px">
              <img src="<?php echo  assets('images/teeth.png') ; ?>" onclick="$byakuno.AddEmoToChat('8o|');" width="16px">
              <img src="<?php echo  assets('images/love.png') ; ?>" onclick="$byakuno.AddEmoToChat('<3');" width="16px">
            </div>
          </div>
        </div>
        <!-- /.box-footer-->
      </div>
  </section>
  <section class="col-sm-3 chat-holder pull-right online-friends-main-container hide-online-friends" style="bottom:-8px;right:0;position:fixed">
     <section class="box box-widget direct-chat direct-chat-primary direct-chat-contacts-open">
      <!-- .box-header -->
      <section class="box-header with-border online-header" onclick="javascript:$byakuno.ToggleOnlineList();">
        <h3 class="box-title">Emboozi</h3>
        <div class="box-tools pull-right">
          <span data-toggle="tooltip" title="3 New Messages" class="badge bg-light-blue online-count"></span>
          <button type="button" class="btn btn-box-tool"><i class="fa fa-comments"></i></button>  
        </div>
      </section>
      <!-- /.box-header -->
      <section class="box-body online-friends-container hide">
        <!-- Conversations are loaded here -->
        <section class="direct-chat-messages">
          
        </section>
        <!--/.direct-chat-messages-->

        <!-- Contacts are loaded here -->
        <section class="direct-chat-contacts online-friends-container-body">
          <ul class="contacts-list">
            
            <!-- End Contact Item -->
          </ul>
          <!-- /.contatcts-list -->
        </section>
        <!-- /.direct-chat-pane -->
      </section>
      <!-- /.box-body -->
      
    </section>
  </section>
 <footer class="main-footer">
    <div class="container">
      <!--div class="pull-right hidden-xs">
        <b>Version</b> 2.3.8
      </div-->
      <strong>Copyright &copy 2016 byakuno. Powered by <a href="http://mahad.byakuno.com">mahad. </a>.</strong> All rights
      reserved.
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo  assets('css/plugins/jQuery/jquery-2.2.3.min.js') ; ?>"></script>
<script src="<?php echo  assets('css/plugins/datepicker/bootstrap-datepicker.js') ; ?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo  assets('css/bootstrap/js/bootstrap.min.js') ; ?>"></script>
<!-- SlimScroll -->
<script src="<?php echo  assets('css/plugins/slimScroll/jquery.slimscroll.min.js') ; ?>"></script>
<!-- FastClick -->
<script src="<?php echo  assets('css/plugins/fastclick/fastclick.js') ; ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo  assets('css/dist/js/app.min.js') ; ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo  assets('css/dist/js/demo.js') ; ?>"></script>
<script src="<?php echo  assets('js/jquery-ajax-form.js') ; ?>"></script>
<script src="<?php echo  assets('js/jquery-timeago.js') ; ?>"></script>
<script src="<?php echo  assets('js/byakuno-ajax.js') ; ?>"></script>
<script>
  $(function () {
   //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });
    //setInterval('$byakuno.UpdateOnlineList();', 40000);
    
  });
</script>
<audio id="notification-sound" preload="auto">
  <source src="<?php echo  assets('notifications/notification.oga') ; ?>" type="audio/ogg">
  <source src="<?php echo  assets('notifications/notification.mp3') ; ?>" type="audio/mpeg">
  <source src="<?php echo  assets('notifications/notification.wav') ; ?>" type="audio/wav">
</audio>
</body>
</html>