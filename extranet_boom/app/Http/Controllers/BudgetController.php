<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Budget;
use App\Client;
use App\Brand;
use App\Contact;

class BudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $budgets = Budget::orderBy('id', 'desc')->get();
        return view('budget/index', array('module' => 'cotizacion', 'budgets' => $budgets));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('kind', 2)->orderBy('name', 'asc')->get();
        $clients = Client::all();
        $brands = Brand::all();
        $contacts = Contact::all();

        return view('budget/new', array('module' => 'cotizacion', 'users' => $users, 'clients' => $clients, 'brands' => $brands, 'contacts' => $contacts));
    }

    /**
     * Show the form for duplicate a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function duplicate($id)
    {
        $budget = Budget::find($id);
        $users = User::where('kind', 2)->orderBy('name', 'asc')->get();
        $clients = Client::all();
        $brands = Brand::all();
        $contacts = Contact::all();

        return view('budget/duplicate', array('module' => 'cotizacion', 'budget' => $budget, 'users' => $users, 'clients' => $clients, 'brands' => $brands, 'contacts' => $contacts));
    }

    /**
     * Store a newly created resource in storage.,
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'consultant' => 'required|max:255',
            'description' => 'required',
            'note' => 'required',
            'client' => 'required|numeric',
            'brand' => 'required|numeric',
            'contact' => 'required|numeric',
            'amount' => 'required|numeric',
        ]);

        $budget = new Budget;

        $budget->project_name = $request->name;
        $budget->consultant = $request->consultant;
        $budget->description = $request->description;
        $budget->note = $request->note;

        $client = Client::find($request->client);
        $budget->client()->associate($client);

        $brand = Brand::find($request->brand);
        $budget->brand()->associate($brand);

        $contact = Contact::find($request->contact);
        $budget->contact()->associate($contact);

        $budget->amount =  $request->amount;

        if ($budget->save()) {
            return redirect('cotizaciones/actualizar/' . $budget->id)->with('status', array('kind' => 'success', 'message' => 'Cotizaci&oacute;n creada con &eacute;xito.'));
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
			$budget = Budget::find($id);
			return view('budget/print', array('budget' => $budget));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $users = User::where('kind', 2)->orderBy('name', 'asc')->get();
        $budget = Budget::find($id);
        $clients = Client::all();
        $brands = Brand::all();
        $contacts = Contact::all();

        return view('budget/update', array('module' => 'cotizacion', 'budget' => $budget, 'users' => $users, 'clients' => $clients, 'brands' => $brands, 'contacts' => $contacts));
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
        $this->validate($request, [
            'name' => 'required|max:255',
            'consultant' => 'required|max:255',
            'description' => 'required',
            'note' => 'required',
            'client' => 'required|numeric',
            'brand' => 'required|numeric',
            'contact' => 'required|numeric',
            'amount' => 'required|numeric',
        ]);

        $budget = Budget::find($id);

        $budget->project_name = $request->name;
        $budget->consultant = $request->consultant;
        $budget->description = $request->description;
        $budget->note = $request->note;

        $client = Client::find($request->client);
        $budget->client()->associate($client);

        $brand = Brand::find($request->brand);
        $budget->brand()->associate($brand);

        $contact = Contact::find($request->contact);
        $budget->contact()->associate($contact);

        $budget->amount =  $request->amount;

        /**
        * Valid status values
        * 1 Aprobada
        * 2 Anulada
        * 3 Por Aprobar
        * 4 Facturada
        **/
        $budget->status =  $request->status;

        if ($budget->save()) {
            return redirect('cotizaciones/actualizar/' . $budget->id)->with('status', array('kind' => 'success', 'message' => 'Cotizaci&oacute;n actualizada con &eacute;xito.'));
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
