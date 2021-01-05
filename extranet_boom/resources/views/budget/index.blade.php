@extends('layouts.app')
@section('css')
<!-- FooTable -->
<link href="{{ url('css/plugins/footable/footable.core.css') }}" rel="stylesheet">
@endsection
@section('content-header')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Cotizaciones</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/home') }}">Home</a>
            </li>
            <li class="active">
                <strong>Cotizaciones</strong>
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
            <h2 class="items-counter">{{ sizeof($budgets) }} cotizaciones encontradas</h2>
        </div>
        <div class="col-md-4">
              <a href="#" class="btn btn-outline btn-success btn-rounded">Exportar</a>
              <a class="btn btn-outline btn-primary btn-rounded" href="{{ url('/cotizaciones/nuevo') }}">
                  <span><i class="glyphicon glyphicon-plus" aria-hidden="true"></i> Nuevo</span>
              </a>
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
                     <th>Monto</th>
                     <th>Status</th>
                  </tr>
               </thead>
               <tbody>
                   @foreach($budgets as $budget)
                   <tr class="">
                      <td><a href="{{ url('cotizaciones/actualizar') }}/{{ $budget->id }}">{{ $budget->id }}</a></td>
                      <td>{{ date('d/m/Y', strtotime($budget->created_at)) }}</td>
                      <td>{{ $budget->client->name }}</td>
                      <td>{{ $budget->project_name }}</td>
                      <td>{{ $budget->amount }}</td>
                      <td>
                          @if($budget->status == 1)
                          <span class="badge badge-primary">Aprobada</span>
                          @elseif($budget->status == 2)
                          <span class="badge badge-danger">Anulada</span>
                          @elseif($budget->status == 3)
                          <span class="badge">Por aprobar</span>
                          @else
                          <span class="badge badge-success">Facturada</span>
                          @endif
                      </td>
                   </tr>
                   @endforeach
               </tbody>
               <tfoot>
                  <tr>
                     <td colspan="6">
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
