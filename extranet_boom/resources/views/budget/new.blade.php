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
                <a href="{{ url('/home') }}">Home</a>
            </li>
            <li>
                <a href="{{ url('/cotizaciones') }}">Cotizaciones</a>
            </li>
            <li class="active">
                <strong>Nuevo</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
@endsection
@section('content')
<?php /* Notifications */ ?>
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
<form class="" action="{{ url('/cotizaciones/nuevo') }}" method="post">
{!! csrf_field() !!}
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-content text-right">
                <a href="{{ url('/cotizaciones') }}" class="btn btn-outline btn-white btn-rounded">Cancelar</a>
                <button class="btn btn-outline btn-primary btn-rounded form-submit" type="submit">
                  <i class="glyphicon glyphicon-save" aria-hidden="true"></i> Guardar
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
                            <label>Nombre</label>
                            <input type="text" name="name" id="name" placeholder="Nombre del Proyecto" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Consultor</label>
                            <div class="form-group">
                                <select name="consultant" id="consultant" class="form-control" required>
                                    <option value="">-------------</option>
                                    @foreach($users as $user)
                                    <option value="{{ $user->name }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Descripcion</label>
                            <textarea name="description" id="description" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Nota</label>
                            <textarea name="note" id="note" class="form-control"></textarea>
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
                            <option value="">-------------</option>
                            @foreach($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Marca</label>
                    <div class="form-group">
                        <select class="form-control m-b" name="brand" id="brand" required>
                            <option value="">-------------</option>
                            @foreach($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Contacto</label>
                    <div class="form-group">
                        <select class="form-control m-b" name="contact" id="contact" required>
                            <option value="">-------------</option>
                            @foreach($contacts as $contact)
                            <option value="{{ $contact->id }}">{{ $contact->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Costo del Proyecto</h5>
                <div class="ibox-tools">
                </div>
            </div>
            <div class="ibox-content">
              <div class="form-group">
                  <label>Monto</label>
                  <input type="text" name="amount" id="amount" placeholder="0" class="form-control" required>
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
