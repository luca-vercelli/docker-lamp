<?php
// Add numeration the bill
$billId = $bill->id;
$billNumeration = '';

if($bill->id < 10) {
	$billNumeration = '0000';
}

if($bill->id > 10 && $bill->id < 100) {
	$billNumeration = '000';
}

if($bill->id > 100 && $bill->id < 1000) {
	$billNumeration = '00';
}

if($bill->id > 1000 && $bill->id < 10000) {
	$billNumeration = '0';
}


if($billNumeration != '') {
	$billId = $billNumeration.$billId;
}

?>
<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8">
<title>Factura #{{ $billId }}</title>
<link href="{{ url('css/print.css') }}" rel="stylesheet">
</head>

<body>
<div id="wrapper">
  <div id="header">

  </div>
  <div id="main">
	<!-- meta-data -->
    <div id="meta-data">
        <div id="factura-meta">
       	  <div id="factura" >
				Factura No.: {{ $billId }}</div>
            <div id="factura-date" style="display: block;">
            	{{ date('d/m/Y', strtotime($bill->created_at)) }}
            </div>
        </div>
        <div id="client-meta">
        	<div id="address">
            		Cliente: {{ $bill->client->name }}<br />
								Contacto: {{ $bill->budget->contact->name }}<br />
                Direcci&oacute;n: {{ $bill->client->address }}
            </div>
            <div id="phone-numbers">
            	<p>Tel.: {{ $bill->client->phone }}</p>
            </div>
            <div id="company-RIF">
            	<p>RIF.: {{ $bill->client->RIF }}</p>
            </div>
        </div>
        <div id="condition">
        	Condiciones: <b><?php echo ( $bill->condition == 1 ) ? 'Cr&eacute;dito' : 'Contado'; ?></b>
      </div>
    </div><!-- end of meta-data -->
    <!-- Project Name -->
    <div id="project">
   	  Proyecto: {{ $bill->budget->project_name }}
    </div><!-- end of Project Name -->
    <div id="item-wrapper">
    	<table border="0" cellspacing="0" cellpadding="0" class="table">
          <tr>
            <th width="43" scope="col">Cant</th>
            <th width="100" scope="col">&nbsp;</th>
            <th width="520" scope="col" style="text-align: left">Descripci&oacute;n</th>
            <th width="5" scope="col">&nbsp;</th>
            <th width="130" align="left" scope="col">Unitario</th>
            <th width="5" scope="col">&nbsp;</th>
            <th width="130" align="left" scope="col">Total</th>
          </tr>
          <tr>
            <td align="center" valign="top"><p>{{ $bill->quantity }}</p></td>
            <td align="center" valign="top">&nbsp;</td>
            <td style="height:450px; overflow:hidden" valign="top">{!! $bill->budget->description !!}</td>
            <td>&nbsp;</td>
            <td align="left" valign="top"><p>{{ number_format($bill->amount, 2, ",",".") }}</p></td>
            <td align="right">&nbsp;</td>
            <td align="left" valign="top"><p>{{ number_format($bill->sub_total, 2, ",",".") }}</p></td>
          </tr>

          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td align="left">Sub-Total Bs.:</td>
            <td align="right">&nbsp;</td>
            <td align="left">{{ number_format($bill->sub_total, 2, ",",".") }}</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
						<?php
						// get the IVA value to get the percent, e.g. 0.09, 0.20
						// remove the first 0
						$percent = explode('.', $bill->base_IVA); // return somenthing like 01 or 20
						$percent = (String)$percent[1];

						// if the percent still having 0 remove it, example 01, 09
						if (strpos($percent, '0') !== false) {
								$percent = substr($percent, 1); // remove 0
						}
						?>
            <td align="right">I.V.A {{ $percent }}% Sobre Bs.</td>
            <td>&nbsp;</td>
            <td align="left">{{ number_format($bill->sub_total, 2, ",",".") }}</td>
            <td align="right">&nbsp;</td>
            <td align="left">{{ number_format($bill->IVA, 2, ",",".") }}</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td align="left"><b>Total Exento Bs.:</b></td>
            <td>&nbsp;</td>
            <td align="left"><b><?php echo $bill->exemption; ?></b></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td align="left"><b>Total Factura Bs.:</b></td>
            <td>&nbsp;</td>
            <td align="left"><b>{{ number_format($bill->total, 2, ",",".") }}</b></td>
          </tr>
        </table>

    </div>
    <div id="footer">
    	<p>
			FAVOR EMITIR CHEQUE A NOMBRE DE<br>
    		<b>Agencia Boom Digital, C.A.</b><br>
			<b>RIF J-409997405</b>
		</p>
		</div>
  </div>
</div>
</body>
</html>
