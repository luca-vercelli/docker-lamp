@extends('layouts.app')

@section('css')

@endsection

@section('content-header')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Marcas</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/home') }}">Home</a>
            </li>
            <li>
                <a href="{{ url('/admin/marcas') }}">Marcas</a>
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
<form class="" action="{{ url('admin/marcas/actualizar/') }}/{{ $brand->id }}" method="post">
{!! csrf_field() !!}
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-content text-right">
                <a href="{{ url('/admin/marcas/') }}" class="btn btn-outline btn-white btn-rounded">Cancelar</a>
                <button class="btn btn-outline btn-warning btn-rounded form-submit" type="submit">
                  <i class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></i> Guardar
                </button>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Informacion de la marca</h5>
                <div class="ibox-tools">
                </div>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="name" id="name" value="{{ $brand->name }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label>Cliente</label>
                        <select class="form-control m-b" name="client" id="client" required>
                            @foreach($clients as $client)
                            <option value="{{ $client->id }}" @if($client->id == $brand->client->id) selected @endif>{{ $client->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection

@section('scripts')

@endsection
