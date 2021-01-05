@extends('layouts.app')
@section('css')
@endsection
@section('content-header')
<div class="row  border-bottom white-bg dashboard-header">
        <div class="col-lg-12">
            <h2>Hola, {{ Session::get('name') }}</h2>
        </div>
</div>
<div class="row">
  <div class="col-lg-6">
      <div class="ibox float-e-margins">
          <div class="ibox-title">
              <h5><i class="fa fa-clock-o"></i> Ultimas 10 Cotizacicones</h5>
              <div class="ibox-tools">

              </div>
          </div>

          <div class="ibox-content inspinia-timeline">

              @foreach($budgets as $budget)
              <div class="timeline-item">
                  <div class="row">
                      <div class="col-xs-3 date">
                          <i class="fa fa-file-o"></i>
                          {{ date('d/m/Y', strtotime($budget->created_at)) }}
                          <br>
                          <?php
                          // Fuente: http://stackoverflow.com/questions/2040560/how-to-find-number-of-days-between-two-dates-using-php
                          $now = time(); // or your date as well
                          $your_date = strtotime($budget->updated_at);
                          $datediff = $now - $your_date;
                          $numberDays = floor($datediff/(60*60*24));
                          ?>
                          <small class="text-navy">{{ $numberDays }} d&iacute;as</small>
                      </div>
                      <div class="col-xs-7 content no-top-border">
                          <p class="m-b-xs"><strong><a href="{{ url('cotizaciones/actualizar') }}/{{ $budget->id }}">{{ $budget->project_name }}</a></strong></p>
                          <p>{!! $budget->description !!}</p>
                          <p>
                              @if($budget->status == 1)
                              <span class="badge badge-primary">Aprobada</span>
                              @elseif($budget->status == 2)
                              <span class="badge badge-danger">Anulada</span>
                              @elseif($budget->status == 3)
                              <span class="badge">Por aprobar</span>
                              @else
                              <span class="badge badge-success">Facturada</span>
                              @endif
                          </p>
                      </div>
                  </div>
              </div>
              @endforeach
          </div>
      </div>
  </div>

                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5><i class="fa fa-clock-o"></i> Ultimas 10 Facturas</h5>
                            <div class="ibox-tools">

                            </div>
                        </div>

                        <div class="ibox-content inspinia-timeline">


                            @foreach($bills as $bill)
                            <div class="timeline-item">
                                <div class="row">
                                    <div class="col-xs-3 date">
                                        <i class="fa fa-file-o"></i>
                                        {{ date('d/m/Y', strtotime($bill->created_at)) }}
                                        <br>
                                        <?php
                                        // Fuente: http://stackoverflow.com/questions/2040560/how-to-find-number-of-days-between-two-dates-using-php
                                        $now = time(); // or your date as well
                                        $your_date = strtotime($bill->updated_at);
                                        $datediff = $now - $your_date;
                                        $numberDays = floor($datediff/(60*60*24));
                                        ?>
                                        <small class="text-navy">{{ $numberDays }} d&iacute;as</small>
                                    </div>
                                    <div class="col-xs-7 content no-top-border">
                                        <p class="m-b-xs"><strong><a href="{{ url('facturas/actualizar') }}/{{ $bill->id }}">{{ $bill->budget->project_name }}</a></strong></p>
                                        <p>{!! $bill->budget->description !!}</p>
                                        <p>
                                            @if($bill->status == 1)
                                            <span class="badge badge-warning">Por cobrar</span>
                                            @elseif($bill->status == 2)
                                            <span class="badge badge-success">Cobrada</span>
                                            @else
                                            <span class="badge badge-danger">Anulada</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                </div>
@endsection
@section('content')

@endsection
@section('scripts')
@endsection
