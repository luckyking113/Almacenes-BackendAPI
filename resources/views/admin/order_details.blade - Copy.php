
@extends('admin.template.container')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
        <div class="col-md-8">
     
            <label style="font-size: 22px">Detalles de Orden</label>
     
       </div>
            
       </div>
      <ol class="breadcrumb">
        <li><a href="{{asset('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Ordenes</a></li>
        <li class="active">Detalles</li>
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
           <div class='row'>
            <div class='col-md-12'>  
                <dl class="dl-horizontal">
                <dt>Warehouse Naombre</dt>
                <dd>{{$order->warehouse->name}}</dd>
                <dt>Cliente</dt>
                <dd>{{$order->customer->first_name}}&nbsp;{{$order->customer->last_name}}</dd>
                <dt>Status de Orden</dt>
                <dd>{{$order->status}}</dd>
                <dt>Fecha</dt>
                <dd>{{date("m/d/Y H:ia", strtotime($order->created_at))}}</dd>
              </dl>
                
                
           </div>
               </div>
          <hr>
              <table class="table table-bordered " id="table">
                                <thead>
                                    <tr class="filters">
                                        <th>Serie</th>
                                        <th style="width:70px">Imagen</th>
                                        <th>Producto</th>
                                         <th>Categoria</th>
                                         <th>Precio</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $product_ids = explode(",",$order->product_ids);
                                    foreach($product_ids as $key=>$id) {
                                        $product = \App\Product::find($id);
                                    ?>
                                   
                                    
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td style="width:70px">
                                                @if($product->main_image)
                                                <img src="{{asset('public/uploads/product/thumbnail')}}/{{$product->main_image}}" style="width:70px;height:70px">
                                                @endif
                                            </td>
                                            <td>{{$product->name}}</td>
                                            <td>@if(isset($product->category)){{$product->category->name}} @endif</td>
                                            <td>{{$product->price}}</td>
                                            
                                        </tr>
                                   
                                    <?php } ?>   
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
