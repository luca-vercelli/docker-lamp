@extends('layouts.app')
@section('css')
<script src="//cdn.ckeditor.com/4.6.0/basic/ckeditor.js"></script>
@endsection
@section('content-header')
<?php
$defaultIVA = $bill->IVA;
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Facturas</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/home') }}">Home</a>
            </li>
            <li>
                <a href="{{ url('/facturas') }}">Facturas</a>
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
<form class="" action="{{ url('/facturas/actualizar') }}/{{ $bill->id }}" method="post">
{!! csrf_field() !!}
<input type="hidden" name="budget" value="{{ $budget->id }}">
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-content text-right">
                <a href="{{ url('/facturas') }}" class="btn btn-outline btn-white btn-rounded">Cancelar</a>
                <div class="btn-group">
                  <button data-toggle="dropdown" class="btn btn-outline btn-primary btn-rounded dropdown-toggle">Opciones <span class="caret"></span></button>
                  <ul class="dropdown-menu">
                      <li><a href="{{ url('/facturas/imprimir') }}/{{ $bill->id }}" target="_blank" class="font-bold">Imprimir</a></li>
                      <li><a href="{{ url('/notas/nuevo') }}/{{ $bill->id }}" class="font-bold">Nota de cr&eacute;dito</a></li>
                  </ul>
                </div>
                @if($bill->status == 1)
                <button class="btn btn-outline btn-warning btn-rounded form-submit" type="submit">
                  <i class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></i> Guardar
                </button>
                @endif
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
                                <select name="status" id="status" class="form-control" @if( $bill->status == 1 ) required @else disabled @endif>
                                  <option value="1" @if( $bill->status == 1 ) selected @endif>Por cobrar</option>
                                  <option value="2" @if( $bill->status == 2 ) selected @endif>Cobrada</option>
                                  <option value="3" @if( $bill->status == 3 ) selected @endif>Anulada</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Cotizacion</label>
                            <input type="text" name="" id="" value="{{ $budget->id }}" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="name" id="name" value="{{ $budget->project_name }}" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label>Consultor</label>
                            <div class="form-group">
                                <input type="text" name="name" id="name" value="{{ $budget->consultant }}" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Descripcion</label>
                            <textarea name="description" id="description" class="form-control" disabled>{{ $budget->description }}</textarea>
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
                        <select class="form-control m-b" name="client" id="client" disabled>
                            @foreach($clients as $client)
                            <option value="{{ $client->id }}" @if($budget->client->id == $client->id) selected @endif>{{ $client->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>RIF</label>
                    <input type="text" name="RIF" id="RIF" value="{{ $budget->client->RIF }}" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label>Telefono</label>
                    <input type="text" name="phone" id="phone" value="{{ $budget->client->phone }}" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label>Direccion</label>
                    <textarea name="address" id="address" class="form-control" disabled>{{ $budget->client->address }}</textarea>
                </div>
                <div class="form-group">
                    <label>Marca</label>
                    <div class="form-group">
                        <select class="form-control m-b" name="brand" id="brand" disabled>
                            @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" @if($budget->brand->id == $brand->id) selected @endif>{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Contacto</label>
                    <div class="form-group">
                        <select class="form-control m-b" name="contact" id="contact" disabled>
                            @foreach($contacts as $contact)
                            <option value="{{ $contact->id }}" @if($budget->contact->id == $contact->id) selected @endif>{{ $contact->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Costo del proyecto</h5>
                <div class="ibox-tools">
                </div>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Unitario</label>
                            <input type="text" name="amount" id="amount" value="{{ $budget->amount }}" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Cantidad</label>
                            <input type="text" name="quantity" id="quantity" value="1" class="form-control" @if($bill->status == 1) required @else disabled @endif>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Condicion</label>
                            <div class="form-group">
                              <select name="condition" id="condition" class="form-control" disabled>
                                  <option value="1" @if($bill->condition == 1) selected @endif>Cr&eacute;dito</option>
                                  <option value="2" @if($bill->condition == 2) selected @endif>Contado</option>
                              </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Sub total</label>
                            <input type="text" name="sub_total" id="sub_total" value="{{ $bill->sub_total }}" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label>Total excento</label>
                            <input type="text" name="exemption" id="exemption" value="<?php echo $bill->exemption; ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                          <label>IVA</label>
                          <?php $count = 0; ?>
                          @foreach($variables as $variable)
                          <div class="radio">
                            <label>
                              <input type="radio" name="IVA" id="IVA{{ $count }}" value="{{ $variable->value }}" @if($bill->base_IVA == $variable->value) checked @endif>
                              {{ $variable->value }}%
                            </label>
                          </div>
                          @endforeach
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Total</label>
                            <input type="text" name="total" id="total" value="{{ $bill->total }}" class="form-control" disabled>
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
<script type="text/javascript" src="{{ url('js/main.js') }}"></script>
<script type="text/javascript">
  let quantity = {{ $bill->quantity }};
  let base_iva = {{ $defaultIVA }};
  let amount = {{ $bill->amount }};
  let sub_total = {{ $bill->sub_total }}
  let iva = {{ $bill->IVA }};

  updateValues();
  CKEDITOR.replace( 'description' );
</script>
@endsection
