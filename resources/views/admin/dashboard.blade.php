
@extends('admin.template.container')
@section('css') 
<link rel="stylesheet" type="text/css" href="{{asset('assets/slick/slick.css')}}">

 <link rel="stylesheet" type="text/css" href="{{asset('assets/slick/slick-theme.css')}}">
<style type="text/css">
    

    .slider {
        width: 100%;
        margin-top: 10px ;
    }

    .slick-slide {
      margin: 0px 20px;
    }

    .slick-slide img {
      width: 100%;
    }

    .slick-prev:before,
    .slick-next:before {
      color: black;
    }


    .slick-slide {
      transition: all ease-in-out .3s;
      opacity: .5;
    }

    .slick-active {
      opacity: 1;
    }

    .slick-current {
      opacity: 1;
    }
  </style>
@endsection
@section('content')
<?php $order_status = array('1'=>'Pendiente','2'=>'Procesando','3'=>'En Recolecci�n','4'=>'Recolectada','5'=>'En Camino','6'=>'Entregado','7'=>'Completed');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        
        
            <h1 style="margin-top:0px">
     Vista General {{$warehouse_name}}
        <small>Panel de Control</small>
      </h1>
        
        
            
    </section>

    <!-- Main content -->
    <section class="content">
        
      <!-- Small boxes (Stat box) -->

      <!-- /.row -->
      <!-- Main row -->
      
      <div class="row">
         
<!--    <div>
      <img src="http://placehold.it/350x300?text=1">
    </div>
    <div>
      <img src="http://placehold.it/350x300?text=2">
    </div>
    <div>
      <img src="http://placehold.it/350x300?text=3">
    </div>
    <div>
      <img src="http://placehold.it/350x300?text=4">
    </div>
    <div>
      <img src="http://placehold.it/350x300?text=5">
    </div>
    <div>
      <img src="http://placehold.it/350x300?text=6">
    </div>-->
  
     <section class="regular slider">
         @foreach($all_warehouse_list as $warehouse)
            <div class="col-md-4 col-sm-6 col-xs-12">
               
              <div class="info-box">
                   <a href="{{asset('admin/admin_dashboard')}}/{{$warehouse->id}}">
                  <span class="info-box-icon bg-aqua" style="line-height:0px"><img src="{{asset('public/uploads/warehouse/thumbnail')}}/{{$warehouse->image}} " style="height:100%"></span>
                  </a>
                <div class="info-box-content">
                  <span class="info-box-text"><strong>{{$warehouse->name}}</strong></span>
                  <span class="info-box-number" style="font-weight:normal;padding-top: 3px;font-size: 13px">{{$warehouse_performance[$warehouse->id]}}<small>%</small> <small style="float: right;font-weight: normal">Rendimiento</small></span>
                  <span class="info-box-number" style="font-weight:normal;font-size: 13px">{{$warehouse_capacity_performance[$warehouse->id]}}<small>%</small> <small style="float: right;font-weight: normal">Inventario</small></span>
                  <span class="info-box-number" style="font-weight:normal;font-size: 13px">{{$warehouse_report[$warehouse->id]}}<small style="float: right;font-weight: normal">Reportes sin leer</small></span>
                </div>
                <!-- /.info-box-content -->
              </div>
                    
              <!-- /.info-box -->
            </div>
         @endforeach
         <div class="col-md-4 col-sm-6 col-xs-12">
               
             <div class="info-box">
                 <h2 style="margin-top:0px;text-align: center; ">
                     <a href="{{asset('admin/warehouse_list')}}" class="btn btn-success" style="margin-top:8%">Ver Todos los Almacenes</a>
      
      </h2>
             </div>
              </div>
       </section>
       
      </div>
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
        

          <!-- TO DO List -->
          <div class="box box-primary">
            
            <!-- /.box-header -->
            <div class="box-body">
               <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Resumen Mensual</h3>

              <div class="box-tools pull-right">
                
                <div class="col-md-12">
           <div class="form-group">
                  <label for="exampleInputPassword1"></label>
                  <select name='date' id='date' class='form-control' onchange="filterDashboard(this)" style="margin-top: -22px">
                     
                      <option value="1_6_2019" @if($selected_date == "1_6_2019") selected @endif>1, Enero, 2019 ~ 30, Junio, 2019</option>
                      <option value="7_12_2019" @if($selected_date == "7_12_2019") selected @endif>1, Julio, 2019 ~ 31, Dic, 2019</option>
                      <option value="1_6_2020" @if($selected_date == "1_6_2020") selected @endif>1, Enero, 2020 ~ 30, Junio, 2020</option>
                      <option value="7_12_2020" @if($selected_date == "7_12_2020") selected @endif>1, Julio, 2020 ~ 31, Dic, 2020</option>
                 </select>
                  </div>
           </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-8">
                  <p class="text-center">
                    <strong>Ventas: {{$date_text}}</strong>
                  </p>

                  <div class="chart">
                    <!-- Sales Chart Canvas -->
                    <canvas id="salesChart" style="height: 180px;"></canvas>
                  </div>
                  <!-- /.chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <p class="text-center">
                    <strong>Meta de Ventas</strong>
                  </p>

                  <div class="progress-group">
                    <span class="progress-text">Rendimiento</span>
                    <span class="progress-number"><b>{{$performance_goal}}</b>/{{$performance_scale}}</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-aqua" style="width: {{$performance_goal/$performance_scale*100}}%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Inventario</span>
                    <span class="progress-number"><b>{{$total_sell/$warehouse_list->count('id')}}</b>/{{$inventory_scale}}</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-red" style="width: {{$total_sell/$warehouse_list->count('id')/$inventory_scale*100}}%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Reportes</span>
                    <span class="progress-number"><b>{{$total_reports}}</b>/{{$report_scale}}</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-green" style="width: {{$total_reports/$report_scale*100}}%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Visitas Web</span>
                    <span class="progress-number"><b>50</b>/{{$setting->website_scale}}</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-yellow" style="width: {{$total_reports/$setting->website_scale*100}}%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
                    <h5 class="description-header">${{number_format($total_sell,2)}}</h5>
                    <span class="description-text">VENTAS NETAS</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
                    <h5 class="description-header">${{number_format($total_cost, 2)}}</h5>
                    <span class="description-text">COSTO TOTAL</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
                    <h5 class="description-header">${{number_format($total_sell-$total_cost,2)}}</h5>
                    <span class="description-text">GANANCIA TOTAL</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block">
                    <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
                    <h5 class="description-header">{{$total_sell/$warehouse_list->count('id')+ $performance_goal+$total_reports+50}}</h5>
                    <span class="description-text">METAS DE VENTAS</span>
                  </div>
                  <!-- /.description-block -->
                </div>
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div> 
                
                
                
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
              
            </div>
            <!-- /.box-body -->
            
          </div>
          
          <div class="row">
        <!-- Left col -->
        <div class="col-md-8">
          <!-- MAP & BOX PANE -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Reporte de Visitas</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="row">
                <div class="col-md-9 col-sm-8">
                  <div class="pad">
                    <!-- Map will be created here -->
                    <div id="world-map-markers" style="height: 325px;"></div>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-4">
                  <div class="pad box-pane-right bg-green" style="min-height: 280px">
                    <div class="description-block margin-bottom">
                      <div class="sparkbar pad" data-color="#fff">90,70,90,70,75,80,70</div>
                      <h5 class="description-header">8390</h5>
                      <span class="description-text">Visitas</span>
                    </div>
                    <!-- /.description-block -->
                    <div class="description-block margin-bottom">
                      <div class="sparkbar pad" data-color="#fff">90,50,90,70,61,83,63</div>
                      <h5 class="description-header">30%</h5>
                      <span class="description-text">Referidos</span>
                    </div>
                    <!-- /.description-block -->
                    <div class="description-block">
                      <div class="sparkbar pad" data-color="#fff">90,50,90,70,61,83,63</div>
                      <h5 class="description-header">70%</h5>
                      <span class="description-text">Organico</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          
          <!-- /.box -->
        </div>
        <!-- /.col -->

        <div class="col-md-4">
          <!-- Info Boxes Style 2 -->
          <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Likes de Facebook</span>
              <span class="info-box-number">5,200</span>

              <div class="progress">
                <div class="progress-bar" style="width: 50%"></div>
              </div>
              <span class="progress-description">
                    50% Incremento en 30 Dias
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Seguidores en Instragram</span>
              <span class="info-box-number">92,050</span>

              <div class="progress">
                <div class="progress-bar" style="width: 20%"></div>
              </div>
              <span class="progress-description">
                    20% Incremento en 30 Dias
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          <div class="info-box bg-red">
            <span class="info-box-icon"><i class="ion ion-ios-cloud-download-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Categoria Mas Vendida</span>
              <span class="info-box-number">{{$top_selling_cat}}</span>
@if($top_selling_cat)
              <div class="progress">
                <div class="progress-bar" style="width: {{$top_cat_increase}}%"></div>
              </div>
              <span class="progress-description">
                    {{$top_cat_increase}}% Incremento en 30 dias
                  </span>
@endif
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="ion-ios-chatbubble-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Categoria Menos Vendida</span>
              <span class="info-box-number">{{$least_selling_cat}}</span>
@if($least_selling_cat)
              <div class="progress">
                <div class="progress-bar" style="width: {{$least_cat_increase}}%"></div>
              </div>
              <span class="progress-description">
                    {{$least_cat_increase}}% Incremento en 30 dias
                  </span>
@endif
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->

          
          
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
<div class="row">
            <div class="col-md-4">
              <!-- DIRECT CHAT -->
              <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Descuentos y Promociones</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">
                  @foreach($discounts as $discount)
                <li class="item">
                  <div class="product-img">
                    <img src="{{asset('assets/dist/img/default-50x50.gif')}}" alt="Product Image">
                  </div>
                  <div class="product-info">
                    <a href="javascript:void(0)" class="product-title">{{$discount->name}}
                      <span class="label label-warning pull-right">{{$discount->used}} veces usado</span></a>
                    <span class="product-description">
                         {{date('M d, Y', strtotime($discount->start_time))}}-{{date('M d, Y', strtotime($discount->end_time))}}
                        </span>
                  </div>
                </li>
                @endforeach
                
                <!-- /.item -->
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <a href="{{asset('admin/discounts')}}" class="uppercase">Ver todos los Descuentos y Promociones</a>
            </div>
            <!-- /.box-footer -->
          </div>
              <!--/.direct-chat -->
            </div>
            <!-- /.col -->

            <div class="col-md-4">
              <!-- USERS LIST -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Clientes Recientes</h3>

                  <div class="box-tools pull-right">
                    <span class="label label-danger">{{$users->count('id')}} Clientes Nuevos</span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <ul class="users-list clearfix">
                   @foreach ($users as $user)
                    <li>
                        @if($user->image)
                        <img src="{{$user->image}}" alt="User Image" style="width:67px;height: 67px">
                        @else
                          <img src="{{asset('assets/dist/img/user1-128x128.jpg')}}" alt="User Image">
                        @endif
                      <a class="users-list-name" href="{{asset('admin/warehouse_user_edit')}}/{{$user->id}}">{{$user->first_name}}&nbsp;{{$user->last_name}}</a>
                      <span class="users-list-date">{{date('d M', strtotime($user->created_at))}}</span>
                    </li>
                    @endforeach
                  </ul>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="{{asset('admin/customers_list')}}" class="uppercase">Ver Todos los Clientes</a>
                </div>
                <!-- /.box-footer -->
              </div>
              <!--/.box -->
            </div>
            
            <div class="col-md-4">
              <!-- USERS LIST -->
              <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Productos Mas Vendidos</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">
                  @foreach($top_selling_products as $item)
                <li class="item">
                  <div class="product-img">
                   @if(isset($item->product))
                     <img src="{{asset('public/uploads/product/thumbnail')}}/{{$item->product->main_image}}" alt="Product Image">
                   @else
                     <img src="{{asset('assets/dist/img/default-50x50.gif')}}" alt="Product Image">
                   @endif  
                  </div>
                  <div class="product-info">
                    <a href="javascript:void(0)" class="product-title">{{$item->product->name}}
                      <span class="label label-warning pull-right">${{$item->total_price}}</span></a>
                    <span class="product-description">
                          {{substr($item->product->description,0,50)}}
                        </span>
                  </div>
                </li>
               @endforeach
                
                <!-- /.item -->
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <a href="{{asset('admin/top_product_list')}}" class="uppercase">Ver Todos los Productos</a>
            </div>
            <!-- /.box-footer -->
          </div>
              <!--/.box -->
            </div>
            <!-- /.col -->
          </div>
          
          <div class="row">
            <div class="col-md-8">
              <!-- DIRECT CHAT -->
              <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Ordenes Recientes</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Order ID</th>
                    <th>Customerr</th>
                    <th>Status</th>
                    <th>Warehouse</th>
                  </tr>
                  </thead>
                  <tbody>
                      @foreach($latest_orders as $lorder)
                  <tr>
                    <td><a href="{{asset('admin/order_details')}}/{{$lorder->id}}">{{$lorder->order_id}}</a></td>
                    <td>{{$lorder->customer->first_name}}&nbsp;{{$lorder->customer->last_name}}</td>
                    <td><span class="label @if($lorder->status == '7') label-success @elseif($lorder->status == 6) label-warning @else label-default @endif">{{$order_status[$lorder->status]}}</span></td>
                    <td>
                      @if(isset($lorder->warehouse)){{$lorder->warehouse->name}} @endif
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              
              <a href="{{asset('admin/orders')}}" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
            </div>
            <!-- /.box-footer -->
          </div>
              <!--/.direct-chat -->
            </div>
          
            
            <div class="col-md-4">
              <!-- USERS LIST -->
              <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Productos Menos Vendidos</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">
                  @foreach($least_selling_products as $item)
                <li class="item">
                  <div class="product-img">
                   @if(isset($item->product))
                     <img src="{{asset('public/uploads/product/thumbnail')}}/{{$item->product->main_image}}" alt="Product Image">
                   @else
                     <img src="{{asset('assets/dist/img/default-50x50.gif')}}" alt="Product Image">
                   @endif  
                  </div>
                  <div class="product-info">
                    <a href="javascript:void(0)" class="product-title">{{$item->product->name}}
                      <span class="label label-warning pull-right">${{$item->total_price}}</span></a>
                    <span class="product-description">
                          {{substr($item->product->description,0,50)}}
                        </span>
                  </div>
                </li>
               @endforeach
                
                <!-- /.item -->
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <a href="{{asset('admin/least_product_list')}}" class="uppercase">Ver Todos los Productos</a>
            </div>
            <!-- /.box-footer -->
          </div>
              <!--/.box -->
            </div>
            <!-- /.col -->
          </div>
        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
@endsection
@section('js')
  
<script>
    
    function filterDashboard(obj)
         {
             var date = $('#date').val();
            
             window.location.href="<?php echo asset('admin/admin_dashboard');?>/0/"+date;
         }
    $(function () {

  'use strict';

  /* ChartJS
   * -------
   * Here we will create a few charts using ChartJS
   */

  // -----------------------
  // - MONTHLY SALES CHART -
  // -----------------------

  // Get context with jQuery - using jQuery's .get() method.
  var salesChartCanvas = $('#salesChart').get(0).getContext('2d');
  // This will get the first returned node in the jQuery collection.
  var salesChart       = new Chart(salesChartCanvas);

  var salesChartData = {
    labels  : [<?php echo $monthArray;?>],
    datasets: [
     
      {
        label               : 'Warehouse Performance',
        fillColor           : 'rgba(60,141,188,0.9)',
        strokeColor         : 'rgba(60,141,188,0.8)',
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : [<?php echo implode(',',$warehouse_performance_1);?>]
      },
      {
        label               : 'Goal Completion',
        fillColor           : 'rgb(210, 214, 222)',
        strokeColor         : 'rgb(210, 214, 222)',
        pointColor          : 'rgb(210, 214, 222)',
        pointStrokeColor    : '#c1c7d1',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgb(220,220,220)',
        data                : [<?php echo implode(',',$goal_com_array);?>]
      }
    ]
  };

  var salesChartOptions = {
    // Boolean - If we should show the scale at all
    showScale               : true,
    // Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines      : false,
    // String - Colour of the grid lines
    scaleGridLineColor      : 'rgba(0,0,0,.05)',
    // Number - Width of the grid lines
    scaleGridLineWidth      : 1,
    // Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,
    // Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines  : true,
    // Boolean - Whether the line is curved between points
    bezierCurve             : true,
    // Number - Tension of the bezier curve between points
    bezierCurveTension      : 0.3,
    // Boolean - Whether to show a dot for each point
    pointDot                : false,
    // Number - Radius of each point dot in pixels
    pointDotRadius          : 4,
    // Number - Pixel width of point dot stroke
    pointDotStrokeWidth     : 1,
    // Number - amount extra to add to the radius to cater for hit detection outside the drawn point
    pointHitDetectionRadius : 20,
    // Boolean - Whether to show a stroke for datasets
    datasetStroke           : true,
    // Number - Pixel width of dataset stroke
    datasetStrokeWidth      : 2,
    // Boolean - Whether to fill the dataset with a color
    datasetFill             : true,
   
    // String - A legend template
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio     : true,
    // Boolean - whether to make the chart responsive to window resizing
    responsive              : true,
    multiTooltipTemplate: "<%= datasetLabel %> - <%= value %>"
    
  };

  // Create the line chart
  salesChart.Line(salesChartData, salesChartOptions);

  // ---------------------------
  // - END MONTHLY SALES CHART -
  // ---------------------------

  

  /* jVector Maps
   * ------------
   * Create a world map with markers
   */
  $('#world-map-markers').vectorMap({
    map              : 'world_mill_en',
    normalizeFunction: 'polynomial',
    hoverOpacity     : 0.7,
    hoverColor       : false,
    backgroundColor  : 'transparent',
    regionStyle      : {
      initial      : {
        fill            : 'rgba(210, 214, 222, 1)',
        'fill-opacity'  : 1,
        stroke          : 'none',
        'stroke-width'  : 0,
        'stroke-opacity': 1
      },
      hover        : {
        'fill-opacity': 0.7,
        cursor        : 'pointer'
      },
      selected     : {
        fill: 'yellow'
      },
      selectedHover: {}
    },
    markerStyle      : {
      initial: {
        fill  : '#00a65a',
        stroke: '#111'
      }
    },
    markers          : [
      { latLng: [41.90, 12.45], name: 'Vatican City' },
      { latLng: [43.73, 7.41], name: 'Monaco' },
      { latLng: [-0.52, 166.93], name: 'Nauru' },
      { latLng: [-8.51, 179.21], name: 'Tuvalu' },
      { latLng: [43.93, 12.46], name: 'San Marino' },
      { latLng: [47.14, 9.52], name: 'Liechtenstein' },
      { latLng: [7.11, 171.06], name: 'Marshall Islands' },
      { latLng: [17.3, -62.73], name: 'Saint Kitts and Nevis' },
      { latLng: [3.2, 73.22], name: 'Maldives' },
      { latLng: [35.88, 14.5], name: 'Malta' },
      { latLng: [12.05, -61.75], name: 'Grenada' },
      { latLng: [13.16, -61.23], name: 'Saint Vincent and the Grenadines' },
      { latLng: [13.16, -59.55], name: 'Barbados' },
      { latLng: [17.11, -61.85], name: 'Antigua and Barbuda' },
      { latLng: [-4.61, 55.45], name: 'Seychelles' },
      { latLng: [7.35, 134.46], name: 'Palau' },
      { latLng: [42.5, 1.51], name: 'Andorra' },
      { latLng: [14.01, -60.98], name: 'Saint Lucia' },
      { latLng: [6.91, 158.18], name: 'Federated States of Micronesia' },
      { latLng: [1.3, 103.8], name: 'Singapore' },
      { latLng: [1.46, 173.03], name: 'Kiribati' },
      { latLng: [-21.13, -175.2], name: 'Tonga' },
      { latLng: [15.3, -61.38], name: 'Dominica' },
      { latLng: [-20.2, 57.5], name: 'Mauritius' },
      { latLng: [26.02, 50.55], name: 'Bahrain' },
      { latLng: [0.33, 6.73], name: 'São Tomé and Príncipe' }
    ]
  });

  /* SPARKLINE CHARTS
   * ----------------
   * Create a inline charts with spark line
   */

  // -----------------
  // - SPARKLINE BAR -
  // -----------------
  $('.sparkbar').each(function () {
    var $this = $(this);
    $this.sparkline('html', {
      type    : 'bar',
      height  : $this.data('height') ? $this.data('height') : '30',
      barColor: $this.data('color')
    });
  });

  // -----------------
  // - SPARKLINE PIE -
  // -----------------
  $('.sparkpie').each(function () {
    var $this = $(this);
    $this.sparkline('html', {
      type       : 'pie',
      height     : $this.data('height') ? $this.data('height') : '90',
      sliceColors: $this.data('color')
    });
  });

  // ------------------
  // - SPARKLINE LINE -
  // ------------------
  $('.sparkline').each(function () {
    var $this = $(this);
    $this.sparkline('html', {
      type     : 'line',
      height   : $this.data('height') ? $this.data('height') : '90',
      width    : '100%',
      lineColor: $this.data('linecolor'),
      fillColor: $this.data('fillcolor'),
      spotColor: $this.data('spotcolor')
    });
  });
});

    </script>

@endsection