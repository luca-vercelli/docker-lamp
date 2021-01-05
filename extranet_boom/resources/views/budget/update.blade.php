@extends('layouts.app')
@section('css')
<script src="//cdn.ckeditor.com/4.6.0/basic/ckeditor.js"></script>
@endsection
@section('content-header')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Cotizaciones</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/') }}">Home</a>
            </li>
            <li>
                <a href="{{ url('/cotizaciones') }}">Cotizaciones</a>
            </li>
            <li class="active">
                <strong>Detalle</strong>
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
<div class="alert alert-danger @if ( ! count($errors) > 0) hide @endif"  role="alert">
  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  <span class="sr-only">Error:</span>
  <span class="msg">
  @foreach ($errors->all() as $error)
    {{ $error }}
  @endforeach
  </span>
</div>
<?php /* End of notifications */ ?>
<form class="" action="{{ url('/cotizaciones/actualizar') }}/{{ $budget->id }}" method="post">
{!! csrf_field() !!}
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-content text-right">
                <a href="{{ url('/cotizaciones') }}" class="btn btn-outline btn-white btn-rounded">Cancelar</a>
                <div class="btn-group">
                  <button data-toggle="dropdown" class="btn btn-outline btn-primary btn-rounded dropdown-toggle">Opciones <span class="caret"></span></button>
                  <ul class="dropdown-menu">
                      <?php /* approved */ ?>
                      @if( $budget->status == 1 )
                      <li><a href="{{ url('/facturas/nuevo') }}/{{ $budget->id }}">Facturar</a></li>
                      @endif
                      <li><a href="{{ url('/cotizaciones/duplicar') }}/{{ $budget->id }}" class="font-bold">Duplicar</a></li>
                      <li><a href="{{ url('/cotizaciones/imprimir') }}/{{ $budget->id }}" target="_blank">Imprimir</a></li>
                  </ul>
                </div>
                <button class="btn btn-outline btn-warning btn-rounded form-submit" type="submit">
                  <i class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></i> Guardar
                </button>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-7">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Informacion del proyecto</h5>
                <div class="ibox-tools">
                </div>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Status</label>
                            <div class="form-group">
                                <select name="status" id="status" class="form-control" required>
                                  <option value="0" @if( $budget->status == 0 ) selected @endif>Por Aprobar</option>
                                  <option value="1" @if( $budget->status == 1 ) selected @endif>Aprobada</option>
                                  <option value="2" @if( $budget->status == 2 ) selected @endif>Anulada</option>
                                  <option value="4" @if( $budget->status == 4 ) selected @endif>Facturada</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="name" id="name" value="{{ $budget->project_name }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Consultor</label>
                            <div class="form-group">
                                <select name="consultant" id="consultant" class="form-control" required>
                                    @foreach($users as $user)
                                    <option value="{{ $user->name }}" @if($budget->consultant == $user->name) selected @endif>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Descripcion</label>
                            <textarea name="description" id="description" class="form-control" required>{{ $budget->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Nota</label>
                            <textarea name="note" id="note" class="form-control">{{ $budget->note }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Datos del cliente</h5>
                <div class="ibox-tools">
                </div>
            </div>
            <div class="ibox-content">
                <div class="form-group">
                    <label>Nombre</label>
                    <div class="form-group">
                        <select class="form-control m-b" name="client" id="client" required>
                            @foreach($clients as $client)
                            <option value="{{ $client->id }}" @if($budget->client->id == $client->id) selected @endif>{{ $client->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Marca</label>
                    <div class="form-group">
                        <select class="form-control m-b" name="brand" id="brand" required>
                            @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" @if($budget->brand->id == $brand->id) selected @endif>{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Contacto</label>
                    <div class="form-group">
                        <select class="form-control m-b" name="contact" id="contact" required>
                            @foreach($contacts as $contact)
                            <option value="{{ $contact->id }}" @if($budget->contact->id == $contact->id) selected @endif>{{ $contact->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Costo del proyecto</h5>
                <div class="ibox-tools">
                </div>
            </div>
            <div class="ibox-content">
              <div class="form-group">
                  <label>Monto</label>
                  <input type="text" name="amount" id="amount" value="{{ $budget->amount }}" class="form-control" required>
              </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection
@section('scripts')
<script>
    CKEDITOR.replace( 'description' );
    CKEDITOR.replace( 'note' );
</script>
@endsection
