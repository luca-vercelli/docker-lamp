<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use App\Client;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $contacts = Contact::orderBy('name', 'asc')->get();
        return view('admin/contact/index', array('module' => 'admin', 'sub_module' => 'contact', 'contacts' => $contacts));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all();
        return view('admin/contact/new', array('module' => 'admin', 'sub_module' => 'contact', 'clients' => $clients));
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
            'client' => 'required|numeric',
        ]);

        $contact = new Contact;

        $contact->name = $request->name;
        $client = Client::find($request->client);
        $contact->client()->associate($client);

        if ($contact->save()) {
            return redirect('admin/contactos')->with('status', array('kind' => 'success', 'message' => 'Contacto creado con &eacute;xito.'));
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
        $contact = Contact::find($id);
        $clients = Client::all();

        return view('admin/contact/update', array('module' => 'admin', 'sub_module' => 'contact', 'contact' => $contact, 'clients' => $clients));
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
            'client' => 'required|numeric',
        ]);

        $contact = Contact::find($id);

        $contact->name = $request->name;
        $client = Client::find($request->client);
        $contact->client()->associate($client);

        if ($contact->save()) {
            return redirect('admin/contactos/actualizar/' . $contact->id)->with('status', array('kind' => 'success', 'message' => 'Contacto actualizado con &eacute;xito.'));
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
