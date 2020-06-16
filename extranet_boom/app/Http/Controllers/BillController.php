<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;
use App\Budget;
use App\Client;
use App\Brand;
use App\Contact;
use App\Variable;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bills = Bill::orderBy('id', 'desc')->get();
        return view('bill/index', array('module' => 'factura', 'bills' => $bills));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $brands = Brand::all();
        $budget = Budget::find($id);
        $clients = Client::all();
        $contacts = Contact::orderBy('name', 'asc')->get();
        $variables = Variable::orderBy('value', 'asc')->get();

        return view('bill/new', array('module' => 'factura', 'budget' => $budget, 'clients' => $clients, 'brands' => $brands, 'contacts' => $contacts, 'variables' => $variables));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'budget' => 'required|numeric',
            'description' => 'required',
            'condition' => 'required|numeric',
            'quantity' => 'required|numeric',
        ]);

        $budget = Budget::find($request->budget);
        $variables = Variable::orderBy('value', 'asc')->get();

        $bill = new Bill;

        $amount = $budget->amount;
        $quantity = $request->quantity;
        $base_IVA = $request->IVA;

        $bill->condition = $request->condition;
        $bill->quantity = $quantity;
        $bill->amount = $amount;
        $bill->exemption = $request->exemption;
        $bill->base_IVA = $base_IVA;
        $sub_total = ($budget->amount * $quantity);
        $bill->sub_total = $sub_total;

        $IVA = (($amount * $quantity) * $base_IVA);
        $bill->IVA = $IVA;


        $bill->total = $sub_total + $IVA + $bill->exemption;

        $client = Client::find($budget->client->id);
        $bill->client()->associate($client);
        $bill->budget()->associate($budget);

        /* client data */
        $bill->client_name = $budget->client->name;
        $bill->client_short_name = $budget->client->short_name;
        $bill->client_address = $budget->client->address;
        $bill->client_phone = $budget->client->phone;
        $bill->client_RIF = $budget->client->RIF;

        if ($bill->save()) {
            /**
            * Valid status values
            * 1 Aprobada
            * 2 Anulada
            * 3 Por Aprobar
            * 4 Facturada
            **/

            // Update budget status
            $budget->status = 4;
            $budget->save();
            return redirect('facturas/actualizar/' . $bill->id)->with('status', array('kind' => 'success', 'message' => 'Factura creada con &eacute;xito.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
			$bill = Bill::find($id);
			return view('bill/print', array('bill' => $bill));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $bill = Bill::find($id);
      $variables = Variable::orderBy('value', 'asc')->get();

      $clients = Client::all();
      $brands = Brand::all();
      $contacts = Contact::all();
      $budget = $bill->budget;

      return view('bill/update', array('module' => 'factura', 'bill' => $bill, 'budget' => $budget, 'clients' => $clients, 'brands' => $brands, 'contacts' => $contacts, 'variables' => $variables));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $bill = Bill::find($id);
        $variables = Variable::all()->first();

        /* Anulada */
        if($request->status == 3){
            $budget = $bill->budget;
            $bill->status = 3;

            if($bill->save()){
                /**
                * Valid status values
                * 1 Aprobada
                * 2 Anulada
                * 3 Por Aprobar
                * 4 Facturada
                **/

                // Update budget status
                $budget->status = 1;
                $budget->save();
                return redirect('cotizaciones/actualizar/'.$budget->id)->with(array('kind' => 'success', 'message' => 'Factura anulada con &eacute;xito.'));
            }
        }else{
            $this->validate($request, [
                'status' => 'required|numeric',
                'quantity' => 'required|numeric',
            ]);
            $amount = $bill->amount;
            $quantity = $request->quantity;
            $base_IVA = $request->IVA;
            $sub_total = ($amount * $quantity);
            $IVA = (($amount * $quantity) * $base_IVA);

            $bill->exemption = $request->exemption;
            $bill->status = $request->status;
            $bill->quantity = $quantity;
            $bill->sub_total = $sub_total;
            $bill->IVA = $IVA;
            $bill->total = $sub_total + $IVA + $bill->exemption;

            if ($bill->save()) {
                return redirect('facturas/actualizar/' . $bill->id)->with(array('kind' => 'success', 'message' => 'Factura actualizada con &eacute;xito.'));
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
