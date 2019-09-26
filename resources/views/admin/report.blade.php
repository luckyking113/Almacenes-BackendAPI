
@extends('admin.template.container')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
        <div class="col-md-8">
     
            <label style="font-size: 22px">Reportes de Almacenistas</label>
     
       </div>
            
       </div>
      <ol class="breadcrumb">
        <li><a href="{{asset('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Reportes de Almacenistas</li>
      </ol>
   
            
    </section>

    <!-- Main content -->
    <section class="content">
     
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <div class="col-md-12">
            <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body">
                @if ($message = Session::get('success'))
           <div class="alert alert-success alert-dismissable margin5" style="text-align: center">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                 <strong>{{ $message }}</strong>
            </div>
           @endif
           
           <div class="row">
               <div class="col-md-8">
            
                   <div class="col-md-4">
           <div class="form-group">
                  <label for="exampleInputPassword1">Almacenes</label>
                  <select name='warehouse' id='warehouse' class='form-control' onchange="filterProduct(this)">
                      <option value="">Todos</option>
                       @foreach($warehouses as $warehouse)
                      <option value='{{$warehouse->id}}' @if($warehouse_id == $warehouse->id) selected @endif>{{$warehouse->name}}</option>
                      @endforeach
                     
                 </select>
                  </div>
           </div>
                 
                   </div>
               
               
           </div> 
            <hr style="margin-top: 0px">
              <table class="table table-bordered " id="table">
                                <thead>
                                    <tr class="filters">
                                        <th>Leido</th>
                                        <th>Fecha</th>
                                        <th>Almacen</th>
                                        <th>Empleado</th>
                                        <th>Producto</th>
                                        <th>Tipo de Reporte</th>
                                        <th>Comentario</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reports as $report)
                                    
                                        <tr>
                                            <td><input type="checkbox" name="report[]" @if($report->status == 1) checked @endif  value="{{$report->id}}" onclick="changeStatus(this)"></td>
                                            <td>
                                               {{date("m/d/Y", strtotime($report->created_at))}}
                                            </td>
                                            <td>
                                               {{$report->warehouse->name}}
                                            </td>
                                            <td>
                                                {{$report->user->name}}
                                            </td>
                                            <td>
                                                @if(isset($report->product)){{$report->product->name}} @endif
                                            </td>
                                            <td>
                                                {{$report->report_type}}
                                            </td>
                                            <td>
                                                {{$report->comment}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
              
              </table>
            </div>
            <!-- /.box-body -->
          </div>
            </div>
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
@endsection
@section('js')
     <script>
         
         function filterProduct(obj)
         {
             var warehouse = $('#warehouse').val();
             if(warehouse == '')
                warehouse = 0;
             window.location.href="<?php echo asset('admin/report');?>/"+warehouse;
         }
         function changeStatus(obj)
         {
             if(obj.checked)
              var status = 1;
            else
                var status = 0;
            var value = obj.value;
            
                        $.ajax({
                       type: "GET",
                       url: '<?php echo asset('admin/change_report_status');?>/'+status+'/'+value,
                       success: function(data)
                       {
                            //$('#section').html('<option value="">Select Section</option>'+data);
                       }
                     });
         }
  $(function () {
    $('#table').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
     @endsection
