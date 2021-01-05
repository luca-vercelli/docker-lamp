@extends('layouts.app')
@section('css')
<!-- FooTable -->
<link href="{{ url('css/plugins/footable/footable.core.css') }}" rel="stylesheet">
@endsection
@section('content-header')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Notas</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/home') }}">Home</a>
            </li>
            <li class="active">
                <strong>Notas</strong>
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
            <h2 class="items-counter">{{ sizeof($notes) }} notas encontradas</h2>
        </div>
        <div class="col-md-4">

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
                      <th>Factura</th>
                  </tr>
               </thead>
               <tbody>
                   @foreach($notes as $note)
                   <tr class="">
                      <td><a href="{{ url('notas/detalle') }}/{{ $note->id }}">{{ $note->id }}</a></td>
                      <td>{{ date('d/m/Y', strtotime($note->created_at)) }}</td>
                      <td>{{ $note->bill->client->name }}</td>
                      <td>{{ $note->bill->budget->project_name }}</td>
                      <td><a href="{{ url('facturas/imprimir') }}/{{ $note->bill->id }}" target="_blank">{{ $note->bill->id }}</a></td>
                      <?php
                      // Fuente: http://stackoverflow.com/questions/2040560/how-to-find-number-of-days-between-two-dates-using-php
                      $now = time(); // or your date as well
                      $your_date = strtotime($note->created_at);
                      $datediff = $now - $your_date;
                      $numberDays = floor($datediff/(60*60*24));
                      if($note->status == 3) $numberDays = 0;
                      ?>

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
    });
</script>
@endsection
