<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clients = Client::orderBy('name', 'asc')->get();
        return view('admin/client/index', array('module' => 'admin', 'sub_module' => 'client', 'clients' => $clients));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/client/new', array('module' => 'admin', 'sub_module' => 'client'));
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
            'name' => 'required|max:255',
            'short_name' => 'required',
            'address' => 'required|max:255',
            'phone' => 'required',
            'RIF' => 'required'
        ]);

        $client = new Client;

        $client->name = $request->name;
        $client->short_name = $request->short_name;
        $client->address = $request->address;
        $client->phone = $request->phone;
        $client->RIF = $request->RIF;

        if ($client->save()) {
            return redirect('admin/clientes')->with('status', array('kind' => 'success', 'message' => 'Cliente creado con &eacute;xito.'));
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::find($id);
        return view('admin/client/update', array('module' => 'admin', 'sub_module' => 'client', 'client' => $client));
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
            'short_name' => 'required',
            'address' => 'required|max:255',
            'phone' => 'required',
            'RIF' => 'required'
        ]);

        $client = Client::find($id);

        $client->name = $request->name;
        $client->short_name = $request->short_name;
        $client->address = $request->address;
        $client->phone = $request->phone;
        $client->RIF = $request->RIF;

        if ($client->save()) {
            return redirect('admin/clientes/actualizar/' . $client->id)->with('status', array('kind' => 'success', 'message' => 'Cliente actualizado con &eacute;xito.'));
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
