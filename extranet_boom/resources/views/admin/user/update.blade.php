@extends('layouts.app')

@section('css')

@endsection

@section('content-header')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Usuarios</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/home') }}">Home</a>
            </li>
            <li>
                <a href="{{ url('/admin/usuarios') }}">Usuarios</a>
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
<form class="" action="{{ url('admin/usuarios/actualizar') }}/{{ $user->id }}" method="post" enctype="multipart/form-data">
{!! csrf_field() !!}
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-content text-right">
                <a href="{{ url('/admin/usuarios') }}" class="btn btn-outline btn-white btn-rounded">Cancelar</a>
                <button class="btn btn-outline btn-warning btn-rounded form-submit" type="submit">
                  <i class="glyphicon glyphicon-save" aria-hidden="true"></i> Guardar
                </button>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Informacion del usuario</h5>
                <div class="ibox-tools">
                </div>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-6">
                        <label>Status</label>
                        <select class="form-control m-b" name="status" id="status" required>
                          <option value="1" @if($user->status == 1) selected @endif>Activo</option>
                          <option value="0" @if($user->status == 0) selected @endif>Desactivado</option>
                        </select>
                    </div>
                    <div class="col-sm-6">

                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control" tabindex="1" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label>Tipo de usuario</label>
                        <select class="form-control m-b" name="kind" id="kind" tabindex="2" required>
                            <option value="4" @if($user->kind == 4) selected @endif>Administrador</option>
                            <option value="3" @if($user->kind == 3) selected @endif>Administracion</option>
                            <option value="2" @if($user->kind == 2) selected @endif>Consultor</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control" tabindex="3" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label for="exampleInputFile">Imagen</label>
                          <input name="image" id="image" type="file">
                          <p class="help-block">Imagen de perfil.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" id="password" placeholder="**********" class="form-control" tabindex="4">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Confimar Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="**********" class="form-control" tabindex="5">
                        </div>
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
