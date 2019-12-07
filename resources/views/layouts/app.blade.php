<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Own Digital | Admin</title>

  <meta charset="utf-8" name="csrf-token" content="{{ csrf_token() }}">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="/css/app.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-notify/0.2.0/css/bootstrap-notify.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
<style media="screen">
  body {
  background-image: url("paper.gif");
  background-color: #cccccc;
  }
</style>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue fixed sidebar-mini" background="{{asset('/images/sip.jpg')}}">
<!-- Site wrapper -->
<div class="wrapper" id="app">

  <!-- header -->
  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo" style="background-color: #222d32">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>ODG</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Owndigital</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->


      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- Messages: style can be found in dropdown.less-->

          <!-- Notifications: style can be found in dropdown.less -->

          <!-- Tasks: style can be found in dropdown.less -->

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="/img/user.png" class="user-image" alt="User Image">
              {{-- <span class="hidden-xs">{{Auth::user()->name}}</span> --}}
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="/img/user.png" class="img-circle" alt="User Image">

                <p>
                  {{Auth::user()->name}}
                </p>
              </li>
              <!-- Menu Body -->

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <router-link to="/profile" class="btn btn-default btn-flat">Profile</router-link>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">Sign out</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- tutup -->

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <!--<div class="user-panel">
        <div class="text-center image">
          <img src="/images/logoku.png" class="img-circle" alt="User Image">
        </div>
      </div>-->
      <!-- search form -->

      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <router-link to="/admin/home"><i class="fa fa-home"></i><span>Home</span> </router-link>
        </li>
        <li class="treeview menu-open" style="height: auto;">
          <a href="#">
            <i class="fa fa-file"></i> <span>Halaman</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: block;">
            <li><router-link to="/admin/halaman"><i class="fa fa-circle-o"></i> Daftar Halaman</router-link></li>
            <li><router-link to="/admin/portolio"><i class="fa fa-circle-o"></i> Portofolio</router-link></li>
          </ul>
        </li>
        <li>
          <router-link to="/admin/tim"><i class="fa fa-user"></i><span>Tim</span> </router-link>
        </li>
        <li>
          <router-link to="/admin/layanan"><i class="fa fa-list-ul"></i><span>Layanan</span> </router-link>
        </li>
        <li>
          <router-link to="/admin/pengaturan"><i class="fa fa-cog"></i><span>Pengaturan Website</span> </router-link>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <router-view></router-view>

    <vue-progress-bar></vue-progress-bar>



  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Versi</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2019 <a href="#">Own Digital Solution</a>.</strong> Hak dilindungi UUD.
  </footer>


  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script type="text/javascript" src="/js/app.js"></script>

</body>
</html>
