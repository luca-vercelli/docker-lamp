@extends('layouts.app')
@section('css')
<!-- FooTable -->
<link href="{{ url('css/plugins/footable/footable.core.css') }}" rel="stylesheet">
@endsection
@section('content-header')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Clientes</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/home') }}">Home</a>
            </li>
            <li class="active">
                <strong>Clientes</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
@endsection
@section('content')
<?php /* Notifications */ ?>
@if(Session::has('status'))
<div class="alert alert-{{ Session::get('status')['kind'] }} alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    {{ Session::get('status')['message'] }}
</div>
@endif
<div class="row">
  <div class="col-lg-12">
    <div class="ibox">
      <div class="ibox-content text-right clearfix">
        <div class="col-md-8 text-left">
            <h2 class="items-counter">{{ sizeof($clients) }} clientes encontrados</h2>
        </div>
        <div class="col-md-4">
            <a href="#" class="btn btn-outline btn-success btn-rounded">Exportar</a>
            <a class="btn btn-outline btn-primary btn-rounded" href="{{ url('/admin/clientes/nuevo') }}">
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
                     <th>Nombre</th>
                     <th>Direccion</th>
                     <th>Telefono</th>
                  </tr>
               </thead>
               <tbody>
                   @foreach($clients as $client)
                   <tr class="">
                      <td><a href="{{ url('admin/clientes/actualizar') }}/{{ $client->id }}">{{ $client->name }}</a></td>
                      <td>{{ $client->address }}</td>
                      <td>{{ $client->phone }}</td>
                   </tr>
                   @endforeach
               </tbody>
               <tfoot>
                  <tr>
                     <td colspan="5">
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
