
@extends('admin.template.container')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Vista General de Inventario
        <small>Panel de Control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li class="active">Vista General de Inventario</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      
      <div class="row">
               <div class="col-md-12">
             
                  
                   <div class="col-md-4">
           <div class="form-group">
                  <label for="exampleInputPassword1">Filtrar por Almacen</label>
                  <select name='warehouse' id='warehouse' class='form-control' onchange="filterProduct(this)">
                      <option value="">All</option> 
                      @foreach($warehouses as $warehouse)
                      <option value='{{$warehouse->id}}' @if($selected_warehouse == $warehouse->id) selected @endif>{{$warehouse->name}}</option>
                      @endforeach
                     
                 </select>
                  </div>
           </div>
                
                   </div>
               
               
           </div> 
            <hr style="margin-top: 0px;">
      <div class="row">
          
          <div class="col-lg-3 col-xs-6" style="margin-bottom: 3%">
           
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$total_category}}</h3>

              <p>Cantidad de Categorias</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            
          </div>
        </div>
        
        <div class="col-lg-3 col-xs-6">
         <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$total_products}}</h3>

              <p>Cantidad de Productos</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
          
          </div>
        </div>
       <div class="col-lg-3 col-xs-6" >
           
          <div class="small-box bg-orange">
            <div class="inner">
                <h4 style="font-size: 17px;padding-bottom: 6%"><strong>{{$most_product_move->name}}</strong></h4>

              <p>Productos Mas Transferidos</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            
          </div>
        </div>
          <div class="col-lg-3 col-xs-6" >
           
          <div class="small-box bg-green">
            <div class="inner">
                <h4 style="font-size: 17px;padding-bottom: 6%"><strong>{{$most_warehouse_name->name}}</strong></h4>

              <p>Productos Mas Transferidos</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            
          </div>
        </div>
        
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
        
<div class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>

              <h3 class="box-title">@if(isset($selected_warehouse_name->name)) {{$selected_warehouse_name->name}} @else Warehouses @endif Capacity Percentage</h3>

              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
              <div class="col-xs-6 col-md-3 text-center">
                  <input type="text" class="knob" value="{{$warehouse_capacity}}" data-width="120" data-height="120" data-fgColor="orange" data-readonly="true">

                  <div class="knob-label">Warehouse Capacity %</div>
                </div>

            </div>
            <!-- /.box-body -->
            
          </div>
          <!-- TO DO List -->
          <div class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>

              <h3 class="box-title">Capacidad de Categorias</h3>

              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
               @foreach($category_capacity as $capacity)
             <div class="col-xs-6 col-md-3 text-center">
                  <input type="text" class="knob" value="{{$capacity['capacity']}}" data-width="120" data-height="120" data-fgColor="#f56954" data-readonly="true">

                  <div class="knob-label">{{$capacity['name']}}</div>
                </div>
              @endforeach
<!--              <table class="table table-bordered">
                
                  
                <tr>
                  <th style="width: 10px">SL.#</th>
                  <th>Category</th>
                  <th>Capacity %</th>
                  <th style="width: 80px">Total %</th>
                </tr>
                
                
                @foreach($category_capacity as $capacity)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$capacity['name']}}</td>
                  @if($capacity['capacity'] > 30)
                  <td>
                    <div class="progress progress-xs progress-striped active">
                      <div class="progress-bar progress-bar-yellow" style="width: {{$capacity['capacity']}}%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-yellow">{{$capacity['capacity']}}%</span></td>
                  @else
                  <td>
                    <div class="progress progress-xs progress-striped active">
                      <div class="progress-bar progress-bar-danger" style="width: {{$capacity['capacity']}}%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-danger">{{$capacity['capacity']}}%</span></td>
                  @endif
                </tr>
                @endforeach
              </table>-->
            </div>
            <!-- /.box-body -->
            
          </div>
           <div class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>

              <h3 class="box-title">Capacidad de SubCategorias</h3>

              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
               
              <table class="table table-bordered" id="cat_table">
                <thead>
                  
                <tr>
                  <th style="width: 10px">SL.#</th>
                  <th>Category</th>
                  <th>Capacity %</th>
                  <th style="width: 80px">Total %</th>
                </tr>
                </thead>
                <tbody>
                @foreach($subcategory_capacity as $capacity)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td><a href="{{asset('admin/product_list_subcat')}}/{{$capacity['id']}}">{{$capacity['name']}}</a></td>
                  @if($capacity['capacity'] > 30)
                  <td>
                    <div class="progress progress-xs progress-striped active">
                      <div class="progress-bar progress-bar-yellow" style="width: {{$capacity['capacity']}}%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-yellow">{{$capacity['capacity']}}%</span></td>
                  @else
                  <td>
                    <div class="progress progress-xs progress-striped active">
                      <div class="progress-bar progress-bar-danger" style="width: {{$capacity['capacity']}}%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-danger">{{$capacity['capacity']}}%</span></td>
                  @endif
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

              <h3 class="box-title">Capacidad de Productos</h3>

              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
               <table class="table table-bordered " id="table">
                
                <thead>  
                <tr>
                  <th style="width: 10px">SL.#</th>
                  <th>Product</th>
                  <th>Capacity %</th>
                  <th style="width: 80px">Total %</th>
                </tr>
                </thead>
                <tbody>
                @foreach($product_capacity as $capacity)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$capacity['name']}}</td>
                  @if($capacity['capacity'] > 30)
                  <td>
                    <div class="progress progress-xs progress-striped active">
                      <div class="progress-bar progress-bar-yellow" style="width: {{$capacity['capacity']}}%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-yellow">{{$capacity['capacity']}}%</span></td>
                  @else
                  <td>
                    <div class="progress progress-xs progress-striped active">
                      <div class="progress-bar progress-bar-danger" style="width: {{$capacity['capacity']}}%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-danger">{{$capacity['capacity']}}%</span></td>
                  @endif
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
    $('#cat_table').DataTable();
    
  })
  
  
   function filterProduct(obj)
         {
            var warehouse = $('#warehouse').val();
            window.location.href="<?php echo asset('admin/warehouse_dashboard');?>/"+warehouse;
         }
</script>
<script src="{{asset('assets/bower_components/jquery-knob/js/jquery.knob.js')}}"></script>
<script>
  $(function () {
    /* jQueryKnob */

    $(".knob").knob({
      /*change : function (value) {
       //console.log("change : " + value);
       },
       release : function (value) {
       console.log("release : " + value);
       },
       cancel : function () {
       console.log("cancel : " + this.value);
       },*/
      draw: function () {

        // "tron" case
        if (this.$.data('skin') == 'tron') {

          var a = this.angle(this.cv)  // Angle
              , sa = this.startAngle          // Previous start angle
              , sat = this.startAngle         // Start angle
              , ea                            // Previous end angle
              , eat = sat + a                 // End angle
              , r = true;

          this.g.lineWidth = this.lineWidth;

          this.o.cursor
          && (sat = eat - 0.3)
          && (eat = eat + 0.3);

          if (this.o.displayPrevious) {
            ea = this.startAngle + this.angle(this.value);
            this.o.cursor
            && (sa = ea - 0.3)
            && (ea = ea + 0.3);
            this.g.beginPath();
            this.g.strokeStyle = this.previousColor;
            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
            this.g.stroke();
          }

          this.g.beginPath();
          this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
          this.g.stroke();

          this.g.lineWidth = 2;
          this.g.beginPath();
          this.g.strokeStyle = this.o.fgColor;
          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
          this.g.stroke();

          return false;
        }
      }
    });
    /* END JQUERY KNOB */
    </script>
@endsection

