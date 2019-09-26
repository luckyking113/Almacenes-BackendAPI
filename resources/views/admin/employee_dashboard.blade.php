
@extends('admin.template.container')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Vista General | Manejo de Empleados
        <small>Panel de Control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Vista General del Manejo de Empleados</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
<!--      <div class="row">
        <div class="col-lg-3 col-xs-6">
           small box 
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>150</h3>

              <p>New Orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
         ./col 
        <div class="col-lg-3 col-xs-6">
           small box 
          <div class="small-box bg-green">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>

              <p>Bounce Rate</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
         ./col 
        <div class="col-lg-3 col-xs-6">
           small box 
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>44</h3>

              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
         ./col 
        <div class="col-lg-3 col-xs-6">
           small box 
          <div class="small-box bg-red">
            <div class="inner">
              <h3>65</h3>

              <p>Unique Visitors</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
         ./col 
      </div>-->
      <!-- /.row -->
      <!-- Main row -->
      
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
        

          <!-- TO DO List -->
          <div class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>

              <h3 class="box-title">Manejo de Empleados</h3>

              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                
                 
                <hr />
                <div class='row'>
          <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-orange">
            <div class="inner">
              <h3>{{$top_low_warehosue[count($top_low_warehosue) - 1]['value']}}</h3>

              <p>{{$top_low_warehosue[count($top_low_warehosue) - 1]['name']}}</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer"><strong>Almacen de Mayor Rendimiento</strong></a>
          </div>
        </div>
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$type_performance[0]['value']}}</h3>

              <p>{{$type_performance[0]['type_name']}} | {{$type_performance[0]['warehouse_name']}}</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer"><strong>Departamento de Mayor Rendimiento</strong></a>
          </div>
        </div>
                    
        <div class="col-lg-4 col-xs-6"> 
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{@$user_performance[count($user_performance) - 1]['value']}}</h3>

              <p>{{@$user_performance[count($user_performance) - 1]['name']}} | {{@$user_performance[count($user_performance) - 1]['user_type_name']}} | {{@$user_performance[count($user_performance) - 1]['user_warehouse']}}</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer"><strong>Empleado de Mayor Rendimiento</strong></a>
          </div>
        </div>
      </div>
                <div class="row">
          <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$top_low_warehosue[0]['value']}}</h3>

              <p>{{$top_low_warehosue[0]['name']}}</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer"><strong>Almacen de Menor Rendimiento</strong></a>
          </div>
        </div>
          
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$low_type_performance[0]['value']}}</h3>

              <p>{{$low_type_performance[0]['type_name']}} | {{$low_type_performance[0]['warehouse_name']}}</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer"><strong>Departamento de Menor Rendimiento</strong></a>
          </div>
        </div>
       <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-orange">
            <div class="inner">
              <h3>{{@$user_performance[0]['value']}}</h3>

              <p>{{@$user_performance[0]['name']}} | {{@$user_performance[0]['user_type_name']}} | {{@$user_performance[0]['user_warehouse']}}</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer"><strong>Empleado de Menor Rendimiento</strong></a>
          </div>
        </div>
                    </div>
        
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
              
            </div>
            <!-- /.box-body -->
            
          </div>
          
          <div class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>

              <h3 class="box-title">Rendimiento de Almacenes</h3>

              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                
                 
               
                
                <div class="chart">
                 
                    <canvas id="areaChart" style="height:250px"></canvas>
                      
              </div>
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
              
            </div>
            <!-- /.box-body -->
            
          </div>
          
          <div class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>

              <h3 class="box-title">Lista de Rendimiento de Almacenes</h3>

              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                
                <div class="row">
               <div class="col-md-8">
            
                   <div class="col-md-4">
           <div class="form-group">
                  <label for="exampleInputPassword1">Almacen</label>
                  <select name='warehouse' id='warehouse' class='form-control' onchange="filterWarehouse(this)">
                      <option value="">Todos</option>
                       @foreach($warehouses as $warehouse)
                      <option value='{{$warehouse->id}}' @if($selected_warehouse == $warehouse->id) selected @endif>{{$warehouse->name}}</option>
                      @endforeach
                     
                 </select>
                  </div>
           </div>
                   <div class="col-md-4">
           <div class="form-group">
                  <label for="exampleInputPassword1">&nbsp;</label>
                  <select name='sort' id='sort' class='form-control' onchange="filterWarehouse(this)">
                      <option value="high" @if($selected_sort == 'high') selected @endif>Mayor a Menor</option>
                      <option value="low" @if($selected_sort == 'low') selected @endif>Menor a MAyor</option>
                     
                 </select>
                  </div>
           </div>
                 
                   </div>
               
               
           </div> 
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
               
              <table class="table table-bordered" id="cat_table">
                <thead>
                  
                <tr>
                  <th style="width: 10px">Serie</th>
                  <th>Nombre</th>
                  <th>Barra de Rendimiento</th>
<!--                  <th>Performance Value</th>-->
                </tr>
                </thead>
                <tbody>
                @foreach($warehouse_performance as $warehouse)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$warehouse['name']}}</td>
                  @if($warehouse['value'] > 30)
                  <td>
                     <div class="progress">
                        <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="200" style="width: {{$warehouse['value']/200*100}}%">
                          <span class="sr-only">{{$warehouse['value']}}%</span>
                        </div>
                      </div>
                      {{$warehouse['value']}}%   
                  </td>
<!--                  <td>{{$warehouse['value']}}%</td>-->
                  @else
                  <td>
                      <div class="progress">
                        <div class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="200" style="width: {{$warehouse['value']/200*100}}%">
                          <span class="sr-only">{{$warehouse['value']}}%</span>
                        </div>
                      </div>
                      {{$warehouse['value']}}%   

                  </td>
<!--                  <td>{{$warehouse['value']}}%</td>-->
                  @endif
                </tr>
                @endforeach
                </tbody>
              </table>
<!--              <div class="col-md-12" style="text-align: right">
                <a href="">View All</a>
              </div>-->
            </div>
            <!-- /.box-body -->
            
          </div>
          
          <div class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>

              <h3 class="box-title">Lista de Rendimiento por Departamento</h3>

              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
               <div class="row">
               <div class="col-md-8">
            
                   
                   <div class="col-md-4">
           <div class="form-group">
                  <label for="exampleInputPassword1">&nbsp;</label>
                  <select name='sort_department' id='sort_department' class='form-control' onchange="filterDepartmentWarehouse(this)">
                      <option value="high" @if($selected_dep_sort == 'high') selected @endif>Mayor a Menor</option>
                      <option value="low" @if($selected_dep_sort == 'low') selected @endif>Menor a Mayor</option>
                     
                 </select>
                  </div>
           </div>
                 
                   </div>
               
               
           </div> 
              <table class="table table-bordered" id="cat_table">
                <thead>
                  
                <tr>
                  <th style="width: 10px">Serie</th>
                  <th>Nombre</th>
                  <th>Almacen</th>
                  <th>Reparto</th>
                </tr>
                </thead>
                <tbody>
                @foreach($warehouse_user_performance as $user)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$user['name']}}</td>
                 
                   <td>
                       <div class="progress">
                        <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="200" style="width: {{$user['warehouse_user']/200*100}}%">
                          <span class="sr-only">{{$user['warehouse_user']}}%</span>
                        </div>
                      </div>
                      {{$user['warehouse_user']}}%  
                    
                  </td>
                  <td>
                      <div class="progress">
                        <div class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="200" style="width: {{$user['deliver_man']/200*100}}%">
                          <span class="sr-only">{{$user['deliver_man']}}%</span>
                        </div>
                      </div>
                      {{$user['deliver_man']}}%  
                    
                  </td>
                
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
            
          </div>
          
          <div class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>

              <h3 class="box-title">Lista de Rendimiento de Empleados</h3>

              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
               <div class="row">
               <div class="col-md-8">
            
                   <div class="col-md-4">
           <div class="form-group">
                  <label for="exampleInputPassword1">Almacen</label>
                  <select name='warehouse_user' id='warehouse_user' class='form-control' onchange="filteruser(this)">
                      <option value="">Todos</option>
                       @foreach($warehouses as $warehouse)
                      <option value='{{$warehouse->id}}' @if($selected_user_warehouse == $warehouse->id) selected @endif>{{$warehouse->name}}</option>
                      @endforeach
                     
                 </select>
                  </div>
           </div>
                   <div class="col-md-4">
           <div class="form-group">
                  <label for="exampleInputPassword1">Posiciones Laborales</label>
                  <select name='type_user' id='type_user' class='form-control' onchange="filteruser(this)">
                      <option value="">Todas</option>
                       @foreach($user_types as $type)
                      <option value='{{$type->id}}' @if($selected_user_type == $type->id) selected @endif>{{$type->name}}</option>
                      @endforeach
                     
                 </select>
                  </div>
           </div>
                   
                   <div class="col-md-4">
           <div class="form-group">
                  <label for="exampleInputPassword1">&nbsp;</label>
                  <select name='sort_user' id='sort_user' class='form-control' onchange="filteruser(this)">
                      <option value="high" @if($selected_employee_sort == 'high') selected @endif>Mayor a Menor</option>
                      <option value="low" @if($selected_employee_sort == 'low') selected @endif>Menor a Mayor</option>
                     
                 </select>
                  </div>
           </div>
                 
                   </div>
               
               
           </div> 
              <table class="table table-bordered" id="cat_table">
                <thead>
                  
                <tr>
                  <th style="width: 10px">Serie</th>
                  <th>Nombre</th>
                  <th>Paso 1</th>
                  <th>Paso 2</th>
                  <th>Paso 3</th>
                   <th>Rendimiento</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($user3_performance as $user)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$user['name']}}</td>
                  @if($user['user_type'] != 3)
                  <td>
                      <div class="progress">
                        <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="200" style="width: {{$user['accept_rate']/200*100}}%">
                          <span class="sr-only">{{$user['accept_rate']}}%</span>
                        </div>
                      </div>
                      {{$user['accept_rate']}}%  
                    
                  </td>
                   <td>
                       <div class="progress">
                        <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="200" style="width: {{$user['collect_rate']/200*100}}%">
                          <span class="sr-only">{{$user['collect_rate']}}%</span>
                        </div>
                      </div>
                      {{$user['collect_rate']}}%  
                    
                  </td>
                  <td>
                      <div class="progress">
                        <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="200" style="width: {{$user['deliver_rate']/200*100}}%">
                          <span class="sr-only">{{$user['deliver_rate']}}%</span>
                        </div>
                      </div>
                      {{$user['deliver_rate']}}%  
                    
                  </td>
                  <td>
                      <?php
                      $total_performance = number_format(($user['accept_rate'] + $user['collect_rate'] + $user['deliver_rate'] )/3,2);
                      ?>
                      <div class="progress">
                        <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="200" style="width: {{$total_performance/200*100}}%">
                          <span class="sr-only">{{$total_performance}}%</span>
                        </div>
                      </div>
                      {{$total_performance}}%  
                       
                  </td>
                  @else
                 <td>
                     <div class="progress">
                        <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="200" style="width: {{$user['collect_warehouse_rate']/200*100}}%">
                          <span class="sr-only">{{$user['collect_warehouse_rate']}}%</span>
                        </div>
                      </div>
                      {{$user['collect_warehouse_rate']}}%  
                    
                  </td>
                   <td>
                       
                       <div class="progress">
                        <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="200" style="width: {{$user['arrival_destimation_rate']/200*100}}%">
                          <span class="sr-only">{{$user['arrival_destimation_rate']}}%</span>
                        </div>
                      </div>
                      {{$user['arrival_destimation_rate']}}%  
                    
                  </td>
                  <td>
                      <div class="progress">
                        <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="200" style="width: {{$user['taken_deliver_rate']/200*100}}%">
                          <span class="sr-only">{{$user['taken_deliver_rate']}}%</span>
                        </div>
                      </div>
                      {{$user['taken_deliver_rate']}}%  
                    
                  </td>
                   <td>
                      <?php
                      $total_performance = number_format(($user['collect_warehouse_rate'] + $user['arrival_destimation_rate'] + $user['taken_deliver_rate'] )/3,2);
                      ?>
                       <div class="progress">
                        <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="200" style="width: {{$total_performance/200*100}}%">
                          <span class="sr-only">{{$total_performance}}%</span>
                        </div>
                      </div>
                      {{$total_performance}}%  
                       
                  </td>
                  @endif
                  
                  
                   <td>                <div class="col-md-1" style="width:20px;padding-left: 5px;padding-right: 0px"><a href="{{asset('admin/user_orders')}}/{{$user['user_type']}}/{{$user['user_id']}}" ><i class="fa fa-eye"></i></a></div>
                                          </td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
            
          </div>

          
          <div class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>

              <h3 class="box-title">Reportes Generales</h3>

              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
               
              <table class="table table-bordered " id="table">
                                <thead>
                                    <tr class="filters">
                                        <th>Serie</th>
                                        <th>Almacen</th>
                                        <th>Empleado</th>
                                        <th>Comentario</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reports as $report)
                                    
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                           
                                            <td>
                                               {{$report->warehouse->name}}
                                            <td>
                                                {{$report->user->name}}
                                            </td>
                                           
                                            <td>
                                                {{$report->comment}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
            </div>
            <!-- /.box-body -->
            
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
      $(function () {
    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
    // This will get the first returned node in the jQuery collection.
    var areaChart       = new Chart(areaChartCanvas)

    var areaChartData = {
       labels  : ['Jan','Feb','Mar','Apr','May','Jun', 'July','Aug','Sep','Oct','Nov','Dec'],
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
        }
      ]
    }

    var areaChartOptions = {
      //Boolean - If we should show the scale at all
      showScale               : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : false,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - Whether the line is curved between points
      bezierCurve             : true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension      : 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot                : false,
      //Number - Radius of each point dot in pixels
      pointDotRadius          : 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth     : 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius : 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke           : true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth      : 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill             : true,
      //String - A legend template
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio     : true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive              : true,
      tooltipTemplate: "<%= datasetLabel %> - <%= value %>"
    }

    //Create the line chart
    areaChart.Line(areaChartData, areaChartOptions)

  });
  
    
         function filterWarehouse(obj)
         {
             var warehouse = $('#warehouse').val();
             var sort = $('#sort').val();
             if(warehouse == '')
                warehouse = 0;
            if(sort == '')
                sort = 0;
             window.location.href="<?php echo asset('admin/employee_dashboard');?>/warehouse/"+warehouse+'/'+sort;
         }
         function filteruser(obj)
         {
             var warehouse = $('#warehouse_user').val();
             var sort = $('#sort_user').val();
             var type = $('#type_user').val();
             if(warehouse == '')
                warehouse = 0;
            if(sort == '')
                sort = 0;
            if(type == '')
                type = 0;
             window.location.href="<?php echo asset('admin/employee_dashboard');?>/employee/"+warehouse+'/'+sort+'/'+type;
         }
         
         
         function filterDepartmentWarehouse(obj)
         {
             var sort = $('#sort_department').val();
            if(sort == '')
                sort = 0;
             window.location.href="<?php echo asset('admin/employee_dashboard');?>/dep_warehouse/"+sort;
         }
  </script>
@endsection