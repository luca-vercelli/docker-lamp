<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{{ $budget->id }} - {{ $budget->client->name }} - {{ $budget->project_name }}</title>
<style>
body {
	margin: 0px;
	padding: 0px;
	font-family: Arial, Helvetica, sans-serif;
}

#wrapper {
	width: 815px;
	position: relative;
}

#header {
	width:815px;
	height: 165px;
	float: left;
	position: relative;
}

#logo {
	background-image: url({{ url('img/logo_black.gif') }});
	width: 268px;
	height: 96px;
	margin: 15px 0px 0px 25px;
	position: relative;
	float: left;
}

#info {
	width: 170px;
	height: 130px;
	position: relative;
	float: right;
	margin: 30px 25px 0px 0px;
	color:black;
	font-size: 11px;
	font-style:normal;
	text-decoration:none;
	text-align: right;
}

#info a {
	font-size: 14px;
	text-decoration: none;
	color: #000;
}

#info a.active {
	text-decoration: none;
	color: #000;
}


#info a:hover {
	text-decoration: underline;
	color: #000;
}

#info a:visited {
	text-decoration: none;
	color: #000;
}

#info_date {
	font-size: 14px;
	width: 80px;
	height: 20px;
	position: relative;
	float: right;
	margin: 60px 0px 0px 0px;
	color:black;
	text-align: right;

}

#main {
	width:805px;
	float: left;
	position: relative;
	padding-left: 10px;
}

#title_doc {
	width: 85px;
	height: 48px;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 16px;
	font-weight: bold;
	margin: 0px 0px 0px 360px;
}

#left {
	float: left;
	position: relative;
	font-size: 12px;
	border-top: 1px solid #000;
	border-right: 1px solid #000;
	border-bottom: 1px solid #000;
	border-left: 1px solid #000;
	width: 259px;
	height: 19px;
}

#medium {
	float: left;
	position: relative;
	font-size: 12px;
	border-top: 1px solid #000;
	border-bottom: 1px solid #000;
	width: 259px;
	height: 19px;
}

#right {
	float: left;
	position: relative;
	font-size: 12px;
	border-top: 1px solid #000;
	border-right: 1px solid #000;
	border-bottom: 1px solid #000;
	border-left: 1px solid #000;
	width: 259px;
	height: 19px;
}

#box {
	float: left;
	position: relative;
	font-size: 12px;
	width: 260px;
	height: 30px;
	padding-top: 15px;
}

#box_header {
	float: left;
	position: relative;
	font-size: 12px;
	border-top: 1px solid #000;
	border-right: 1px solid #000;
	border-bottom: 1px solid #000;
	border-left: 1px solid #000;
	width: 780px;
	height: 19px;
	margin: 20px 0px 0px 0px;
}

#box2 {
	float: left;
	position: relative;
	font-size: 12px;
	width: 780px;
	margin: 5px 0px 0px 0px;
}

#box3 {
	float: left;
	position: relative;
	font-size: 12px;
	width: 780px;
	margin: 5px 0px 0px 0px;
	text-align: center;
}

#sign {
	position: relative;
	float: right;
	border-top: 1px solid #000;
	width: 265px;
	height: 17px;
	margin: 40px 0px 0px 0px;
	margin-right: 25px;
	font-size: 12px;
	text-align: center;
	padding-top: 3px;
}

</style>
<link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ url('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
<link href="{{ url('css/animate.css') }}" rel="stylesheet">
</head>

<body>
<div id="wrapper">
	<div id="header">
  		<div id="logo">

      </div>
      <div id="info">
      	<div>
              Agencia Boom Digital C.A.<br />
              boomdigital@gmail.com<br />
              (58-0414-2156576)<br />
          </div>
          <div id="info_date">
      		{{ date('d/m/Y', strtotime($budget->created_at)) }}
      	</div>
      </div>
    </div>
    <div id="main">
    	<div id="title_doc">
        	Cotizaci&oacute;n
        </div>
    	<div id="left">
        	&nbsp;Cliente
        </div>
        <div id="medium">
        	&nbsp;Atenci&oacute;n
        </div>
         <div id="right">
        	&nbsp;Cotizaci&oacute;n No.
        </div>

        <div id="box">
        	{{ $budget->client->name }}
        </div>
        <div id="box">
        	{{ $budget->contact->name }}
        </div>
        <div id="box">
        	{{ $budget->id }}
        </div>

        <div id="left">
        	&nbsp;Nombre del proyecto
        </div>
        <div id="medium">
        	&nbsp;Consultor
        </div>
         <div id="right">

        </div>

        <div id="box">
        	{{ $budget->project_name }}
        </div>
        <div id="box">
        	{{ $budget->consultant }}
        </div>
        <div id="box">

        </div>

        <div id="box_header">
        	&nbsp;Descripci&oacute;n b&aacute;sica del proyecto
        </div>
        <div id="box2">
        	{!! $budget->description !!}
        </div>

        <div id="box_header">
        	&nbsp;Costos
        </div>
        <div id="box3">
        	Costo total en Bol&iacute;vares: <b> {{ number_format( $budget->amount, 2, ',', '.' ) }} </b>
        </div>

        <div id="box_header">
        	&nbsp;Vigencia de la cotizaci&oacute;n
        </div>
        <div id="box2">
        	15 d&iacute;as
        </div>

        <div id="box_header">
        	&nbsp;Condiciones
        </div>
        <div id="box2">
        	Cotizaci&oacute;n en bol&iacute;vares, facturaci&oacute;n en bol&iacute;vares. 	<br />
            Los costos aqu&iacute; presupuestados no incluyen el impuesto (IVA) 		<br />

            El costo de este proyecto puede variar cuando una o todas las siguientes condiciones se apliquen:	<br />
            <ol>
            <li>Los costos est&aacute;n sujetos a cambios si existe una diferencia en el alcance del proyecto, </li>
                 antes del comienzo o durante el mismo.
            <li>Si existe una modificaci&oacute;n en el D&oacute;lar oficial del proyecto. 	</li>
            <li>La validez de este documento caduque.</li>
            </ol>
        </div>
        <div style="visibility: hidden" id="print-note">
        	<div id="box_header">
	        	&nbsp;Nota
	        </div>
	        <div id="box2">
	        	{{ $budget->note }}
	        </div>
        </div>

        <div id="sign">
        	Aprobaci&oacute;n del Cliente
        </div>

    </div>
</div>





<div class="modal inmodal fade in" id="myModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: block;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">NOTA</h4>
            </div>
            <div class="modal-body">
                {!! $budget->note !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Load JS libs -->
<script src="{{ url('js/jquery-2.1.1.js') }}"></script>
<?php /* <script defer src="<?php echo base_url(); ?>js/script-admin.js"></script> */ ?>
<script src="{{ url('js/bootstrap.min.js') }}"></script>
<script>
$(document).ready(function()
{
	@if ( $budget->note != '' )
	$('#myModal').modal('show');
	$('#close-new-user-window').hide('fast');
	@endif

	$('#print').change(function() {
    	if($(this).is(":checked"))
        	$('#print-note').css('visibility', 'visible');
    	else
    		$('#print-note').css('visibility', 'hidden');
	});
});
</script>
</body>
</html>
