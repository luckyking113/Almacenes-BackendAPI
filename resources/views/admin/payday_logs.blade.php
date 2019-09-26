@extends('admin.template.container')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
        <div class="col-md-8">
     
            <label style="font-size: 22px">Historial de Pagos del {{$selected_year}}</label>
     
       </div>
            
       </div>
      <ol class="breadcrumb">
        <li><a href="{{asset('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Historial de Pagos</li>
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
                <div class="col-md-3">
           <div class="form-group">
                  <label for="exampleInputPassword1">Año</label>
                  <?php
                  $year = date("Y");
                  ?>
                  <select name='year' id='year' class='form-control' onchange="filterUser(this)">
                   @for($i = $year; $i >= 2017; $i--)
                     <option value="{{$i}}" @if(@$selected_year == $i) selected @endif >{{$i}}</option>
                    @endfor
                  </select>
                  </div>
           </div>
            </div>
           <hr>
             <form id="productForm" method="POST" action='{{asset('admin/post_payment')}}' enctype="multipart/form-data" onsubmit="return validateUser()" >
                                     {{ csrf_field() }}
                                     
              <table class="table table-bordered " id="payday">
                                <thead>
                                    <tr class="filters">
                                     
                                        <th>Semana</th>
                                         <th>Pago Total</th>
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                       
                                    @foreach ($week_payment as $week=>$payment)
                                    
                                        <tr>
                                          
                                            <td>
                                              <a href="{{asset('admin/weekly_payment_log')}}/{{$selected_year}}/{{$week}}"> Semana {{$week}}</a>
                                            </td>
                                            
                                             <td>
                                               ${{number_format($payment,2)}}
                                            </td>
                                           
                                        </tr>
                                        
                                    @endforeach
                                    
                                </tbody>
                            </table>
                                     
              </form>
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
           function validateUser()
         {
             

if ($('input.users').is(':checked')) {
 return true;
}
else
{
    alert('Favor de Seleccionar Empleado');

return false;
}


         }
         
          function validateTips()
         {
             

if ($('input.orders').is(':checked')) {
 return true;
}
else
{
    alert('Favor de Seleccionar una Orden');

return false;
}
         }
           function filterUser(obj)
         {
             var year = $('#year').val();
            
             if(year == '')
                year = 0;
            
            window.location.href="<?php echo asset('admin/payday_logs');?>/"+year;
         }
         
         $(document).ready(function() {
$('#payday').dataTable({
    "bPaginate": true,
    "bLengthChange": true,
    "bFilter": true,
    "bInfo": true,
    "bAutoWidth": false });
});
 
</script>
     @endsection
