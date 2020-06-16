@extends('layouts.app')
@section('css')
<!-- FooTable -->
<link href="{{ url('css/plugins/footable/footable.core.css') }}" rel="stylesheet">
@endsection
@section('content-header')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Facturas</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/home') }}">Home</a>
            </li>
            <li class="active">
                <strong>Facturas</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
@endsection
@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="ibox">
      <div class="ibox-content text-right clearfix">
        <div class="col-md-8 text-left">
            <h2 class="items-counter">{{ sizeof($bills) }} facturas encontradas</h2>
        </div>
        <div class="col-md-4">
          <form role="form" class="form-inline" name="search" id="search" action="{{ url('/facturas/cliente') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="exampleInputEmail2" class="sr-only">Cliente</label>
              <select name="id" id="id" aria-controls="editable" class="form-control">
                <option value="0">[Seleccionar]</option>
                @foreach($clients as $client)
                <option value="{{ $client->id }}" @if($id_client == $client->id) selected @endif>{{ $client->name }}</option>
                @endforeach
              </select>
            </div>
            <button class="btn btn-outline btn-primary btn-rounded form-submit" type="submit">
              <i class="fa fa-search" aria-hidden="true"></i> Buscar
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
   <div class="col-lg-12">
      <div class="ibox float-e-margins">
         <div class="ibox-title">
            <h5>Resultados</h5>
            <div class="ibox-tools">

            </div>
         </div>
         <div class="ibox-content">
            <input type="text" class="form-control input-sm m-b-xs" id="filter"
               placeholder="Buscar">
            <table class="footable table table-stripped" data-page-size="50" data-filter=#filter>
               <thead>
                  <tr>
                      <th>N&uacute;mero</th>
                      <th>Fecha</th>
                      <th>Cliente</th>
                      <th>Nombre del proyecto</th>
                      <th>Cotizacion</th>
                      <th>Morosidad</th>
                      <th>Status</th>
                  </tr>
               </thead>
               <tbody>
                   @foreach($bills as $bill)
                   <tr class="">
                      <td><a href="{{ url('facturas/actualizar') }}/{{ $bill->id }}">{{ $bill->id }}</a></td>
                      <td>{{ date('d/m/Y', strtotime($bill->created_at)) }}</td>
                      <td>{{ $bill->client->name }}</td>
                      <td>{{ $bill->budget->project_name }}</td>
                      <td><a href="{{ url('cotizaciones/actualizar') }}/{{ $bill->budget->id }}">{{ $bill->budget->id }}</a></td>
                      <?php
                      // Fuente: http://stackoverflow.com/questions/2040560/how-to-find-number-of-days-between-two-dates-using-php
                      $now = time(); // or your date as well
                      $your_date = strtotime($bill->created_at);
                      $datediff = $now - $your_date;
                      $numberDays = floor($datediff/(60*60*24));
                      if($bill->status == 3) $numberDays = 0;
                      ?>
                      <td>{{ $numberDays }} d&iacute;as</td>
                      <td>
                          @if($bill->status == 1)
                          <span class="badge badge-warning">Por cobrar</span>
                          @elseif($bill->status == 2)
                          <span class="badge badge-success">Cobrada</span>
                          @else
                          <span class="badge badge-danger">Anulada</span>
                          @endif
                      </td>
                   </tr>
                   @endforeach
               </tbody>
               <tfoot>
                  <tr>
                     <td colspan="7">
                        <ul class="pagination pull-right"></ul>
                     </td>
                  </tr>
               </tfoot>
            </table>
         </div>
      </div>
   </div>
</div>



@endsection
@section('scripts')
<!-- FooTable -->
<script src="{{ url('js/plugins/footable/footable.all.min.js') }}"></script>
<!-- Page-Level Scripts -->
<script>
    $(document).ready(function() {
        $('.footable').footable();

        $('#search').submit(function(){
          if(document.getElementById("id").value == 0) return false
        })
    });
</script>
@endsection
