@extends('layouts.app')
@section('css')
<script src="//cdn.ckeditor.com/4.6.0/basic/ckeditor.js"></script>
@endsection
@section('content-header')
<?php
$defaultIVA = 0;
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
<form class="" action="{{ url('/facturas/nuevo') }}" method="post">
{!! csrf_field() !!}
<input type="hidden" name="budget" value="{{ $budget->id }}">
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-content text-right">
              <a href="{{ url('/cotizaciones') }}" class="btn btn-outline btn-white btn-rounded">Cancelar</a>
              <button class="btn btn-outline btn-primary btn-rounded form-submit" type="submit">
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
                            <textarea name="description" id="description" class="form-control">{{ $budget->description }}</textarea>
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
                            <input type="text" name="quantity" id="quantity" value="1" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Condicion</label>
                            <div class="form-group">
                              <select name="condition" id="condition" class="form-control" required>
                                  <option value="">-------------</option>
                                  <option value="1">Cr&eacute;dito</option>
                                  <option value="2">Contado</option>
                              </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Sub total</label>
                            <input type="text" name="sub_total" id="sub_total" value="" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label>Total excento</label>
                            <input type="text" name="exemption" id="exemption" value="0.00" placeholder="0.00" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>IVA</label>
                            <?php $count = 0; ?>
                            @foreach($variables as $variable)
                            <?php
                            $count++;
                            if($count == 1) {
                              $defaultIVA = $variable->value;
                            }
                            ?>
                            <div class="radio">
                              <label>
                                <input type="radio" name="IVA" id="IVA{{ $count }}" value="{{ $variable->value }}" @if($count == 1) checked @endif>
                                {{ $variable->value }}%
                              </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Total</label>
                            <input type="text" name="total" id="total" value="" class="form-control" disabled>
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
  let quantity = 1;
  let base_iva = <?php echo $defaultIVA; ?>;
  let amount = {{ $budget->amount }};
  let sub_total;
  let iva;

  updateValues();
  CKEDITOR.replace( 'description' );
</script>
@endsection
