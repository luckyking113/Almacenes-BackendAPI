<!DOCTYPE html>
<?php


error_reporting(0);
ini_set('display_errors', 0);
    $admin_id =  Auth::guard('admin')->id();
     
    // get all stores of logged in vendor
    $user_profile = DB::table('admin')->where('id', $admin_id)->get()[0];
    $url_part = Request::segment(2); 
    $min_products_alerts = \App\Product::join('warehouse_products','products.id','warehouse_products.product')->whereNotNull('warehouse')->whereColumn('quantity', '<', 'min_capacity')->take(5)->get();

    $general_reports_count = \App\WarehouseReport::where('report_type','General report')->where('status', 0)->count();
    $warehouse_reports_count = \App\WarehouseReport::where('report_type','product quantity change report')->where('status', 0)->count();

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>McFly | Tienda de Conveniencia</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('assets/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('assets/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('assets/dist/css/skins/_all-skins.min.css')}}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{asset('assets/bower_components/morris.js/morris.css')}}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{asset('assets/bower_components/jvectormap/jquery-jvectormap.css')}}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{asset('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/timepicker/bootstrap-timepicker.min.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
      .skin-blue .main-header .navbar {

    background-color: #29aae3 !important;

}
.skin-blue .main-header .logo {

    background-color: #29aae3 !important;}
  </style>
   @yield('css')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="{{asset('admin/admin_dashboard')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="{{asset('assets/dist/img/logo.png')}}" style="height: 20px;width: 50px"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="{{asset('assets/dist/img/logo.png')}}" style="height: 38px"></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
         
          <li class="dropdown messages-menu">
            <a href="{{asset('admin/employee_report')}}" class="dropdown-toggle" >
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">{{$general_reports_count}}</span>
            </a>
            
          </li>
          <li class="dropdown notifications-menu">
            <a href="{{asset('admin/unread_report')}}" class="dropdown-toggle" >
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">{{$warehouse_reports_count}}</span>
            </a>
            
          </li>
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">{{$min_products_alerts->count()}}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have {{$min_products_alerts->count()}} products</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                    @foreach($min_products_alerts as $product)
                    <?php
                     $percentage = number_format(($product->quantity / $product->min_capacity) *100,2);
                     $warehouse = \App\Warehouse::find($product->warehouse);
                    ?>
                  <li><!-- Task item -->
                    <a href="javascript:void(0)">
                      <h3>
                        <label>{{$product->name}}</label><br><i>{{@$warehouse->name}}</i></br>
                        <small class="pull-right">{{$product->quantity."/".$product->min_capacity}}</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: {{$percentage}}%" role="progressbar"
                             aria-valuenow="{{$percentage}}" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">{{$percentage}}% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  @endforeach
                </ul>
              </li>
              <li class="footer">
                <a href="{{asset('admin/low_inventory_products')}}">Ver Capacidad de Todos los Almacenes</a>
              </li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                 @if($user_profile->image)
                 <img src="{{asset('public/uploads/warehouse/thumbnail')}}/{{$user_profile->image}}" class="user-image" alt="User Image">
            @else
               <img src="{{asset('assets/dist/img/avatar5.png')}}" class="user-image" alt="User Image">
              @endif
              
              <span class="hidden-xs">{{$user_profile->first_name}}&nbsp;{{$user_profile->last_name}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
               
 @if($user_profile->image)
                 <img src="{{asset('public/uploads/warehouse/thumbnail')}}/{{$user_profile->image}}" class="img-circle" alt="User Image">
            @else
               <img src="{{asset('assets/dist/img/avatar5.png')}}" class="img-circle" alt="User Image">
              @endif
                <p>
                  {{$user_profile->first_name}}&nbsp;{{$user_profile->last_name}}
                  <small>Member since {{date("M. Y", strtotime($user_profile->created_at))}}</small>
                </p>
              </li>
              <!-- Menu Body -->
              
              <!-- Menu Footer-->
              <li class="user-footer">
<!--                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>-->
                <div class="pull-right">
                  <a href="{{asset('admin/logout')}}" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
         
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
            @if($user_profile->image)
                 <img src="{{asset('public/uploads/warehouse/thumbnail')}}/{{$user_profile->image}}" class="img-circle" alt="User Image">
            @else
                <img src="{{asset('assets/dist/img/avatar5.png')}}" class="img-circle" alt="User Image">
              @endif
        </div>
        <div class="pull-left info">
          <p>{{$user_profile->first_name}}&nbsp;{{$user_profile->last_name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">NAVEGACION PRINCIPAL</li>
        <li>
          <a href="{{asset('admin/admin_dashboard')}}">
            <i class="fa fa-bar-chart-o"></i> <span>Vista General</span>
           
          </a>
        </li>
<!--         <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <li><a href="{{asset('admin/admin_dashboard')}}"><i class="fa fa-circle-o"></i> Vista General</a></li>
           <li><a href="{{asset('admin/discounts')}}"><i class="fa fa-circle-o"></i> Descuentos & Promociones</a></li>
           <li><a href="{{asset('admin/register_products')}}"><i class="fa fa-circle-o"></i> Registrar Productos</a></li>
           
            </ul>
        </li>-->
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-database"></i>
            <span>Inventario Central</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <li><a href="{{asset('admin/inventory_dashboard')}}"><i class="fa fa-bar-chart-o"></i> Vista General</a></li>
           <li><a href="{{asset('admin/product_list')}}"><i class="fa fa-cutlery"></i> Productos</a></li>
           <li><a href="{{asset('admin/category_list')}}"><i class="fa fa-folder-open"></i> Categorias</a></li>
           <li><a href="{{asset('admin/products_capacity')}}"><i class="fa fa-server"></i> Capacidades</a></li>
           <li><a href="{{asset('admin/register_products')}}"><i class="fa fa-truck"></i> Registrar Productos</a></li>
           <li><a href="{{asset('admin/register_log')}}"><i class="fa fa-file-text-o"></i> Historial de Registro</a></li>
           <li><a href="{{asset('admin/transfer_products')}}"><i class="fa fa-send"></i> Transferir Productos</a></li>
           <li><a href="{{asset('admin/inventory_log')}}"><i class="fa fa-file-text-o"></i> Historial de Transferencias</a></li>
           
          </ul>
        </li>
        
        
        
        
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-university"></i>
            <span>Almacenes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <li><a href="{{asset('admin/warehouse_dashboard')}}"><i class="fa fa-bar-chart-o"></i> Vista General</a></li>
           <li><a href="{{asset('admin/warehouse_list')}}"><i class="fa fa-university"></i> Almacenes</a></li>
           <li><a href="{{asset('admin/warehouse_product_list')}}"><i class="fa fa-archive"></i> Inventario de Almacenes</a></li>
           <li><a href="{{asset('admin/inventory_capacity')}}"><i class="fa fa-server"></i> Capacidad de Inventario</a></li>
           <li><a href="{{asset('admin/warehouse_user_list')}}"><i class="fa fa-motorcycle"></i> Empleados</a></li>
           <li><a href="{{asset('admin/customer_list')}}"><i class="fa fa-users"></i> Clientes</a></li>
           <li><a href="{{asset('admin/report')}}"><i class="fa fa-ticket"></i> Reportes de Almacenistas</a></li>
          </ul>
        </li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-hand-peace-o"></i>
            <span>Embajadores</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           
            <li><a href="{{asset('admin/user_list')}}"><i class="fa fa-beer"></i> Embajadores</a></li>
            <li><a href="{{asset('admin/group_list')}}"><i class="fa fa-home"></i> Ubicaciones de Embajadas</a></li>
          </ul>
        </li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-eye"></i>
            <span>Manejo de Empleados</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <li><a href="{{asset('admin/employee_dashboard')}}"><i class="fa fa-bar-chart-o"></i> Vista General</a></li>
           <li><a href="{{asset('admin/employee_list')}}"><i class="fa fa-motorcycle"></i> Empleados</a></li>
           <li><a href="{{asset('admin/schedule')}}"><i class="fa fa-calendar"></i> Horarios</a></li>
           <li><a href="{{asset('admin/paydays')}}"><i class="fa fa-dollar"></i> Semana por Pagar</a></li>
           <li><a href="{{asset('admin/payday_logs')}}"><i class="fa fa-money"></i> Historial de Pagos</a></li>
           <li><a href="{{asset('admin/employee_report')}}"><i class="fa fa-ticket"></i> Reportes de Empleados</a></li>
           <li><a href="{{asset('admin/evaluation_scale')}}"><i class="fa fa-hourglass-half"></i> Escala de Rendimiento</a></li>
           <li><a href="{{asset('admin/user_type_list')}}"><i class="fa fa-gears"></i> Posiciones Laborales</a></li>
            </ul>
        </li>
        
         <li>
          <a href="{{asset('admin/time_sheet')}}">
            <i class="fa fa-clock-o"></i> <span>Turnos Laborales</span>
           
          </a>
        </li>
         <li>
          <a href="{{asset('admin/customers_list')}}">
            <i class="fa fa-users"></i> <span>Clientes</span>
           
          </a>
        </li>
        <li>
          <a href="{{asset('admin/orders')}}">
            <i class="fa fa-clipboard"></i> <span>Ordenes</span>
           
          </a>
        </li>
        <li>
            <a href="{{asset('admin/discounts')}}">
                <i class="fa fa-star"></i> <span>Descuentos & Promociones</span>
        </a>
        </li>
       
        
<li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i>
            <span>Cuentas Admin</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <li><a href="{{asset('admin/admin_users')}}"><i class="fa fa-user"></i> Usuarios Admin</a></li>
              </ul>
        </li>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
    
         @yield('content')
        <!-- right-side -->
        
        <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2019 <a href="https://adminlte.io">McFly | Tienda de Conveniencia</a>.</strong> Supervivencia Universitaria
  </footer>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{asset('assets/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('assets/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('assets/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Morris.js charts -->
<script src="{{asset('assets/bower_components/raphael/raphael.min.js')}}"></script>
<script src="{{asset('assets/bower_components/morris.js/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{asset('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('assets/bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('assets/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{asset('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{asset('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('assets/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('assets/dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('assets/dist/js/demo.js')}}"></script>
<script src="{{asset('assets/bower_components/chart.js/Chart.js')}}"></script>

<script src="{{asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/bower_components/datatables.net/js/dataTables.fixedColumns.min.js')}}"></script>
<script src="{{asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('assets/slick/slick.min.js')}}" type="text/javascript" charset="utf-8"></script>
<script>
  $(function () { 
    // $('#table').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
    $('.regular').slick({
  dots: true,
  infinite: false,
  speed: 300,
  slidesToShow: 3,
  slidesToScroll: 3,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});
    $(".regular123").slick({
        dots: true,
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 3
      });
      
       $(".2344regular2").slick({
        dots: true,
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 3,
        arrows:false
      });
      
       $('.regular2').slick({
  dots: true,
  infinite: false,
  speed: 300,
  slidesToShow: 3,
  slidesToScroll: 3,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});
  })
</script>

  <script type="text/javascript">
    $(document).on('ready', function() {
    
      
     
    });
</script>
 @yield('js')
</body>
</html>
