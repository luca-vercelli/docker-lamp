<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;
use App\Brand;
use App\Budget;
use App\Client;
use App\Contact;
use App\Note;
use App\Variable;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $notes = Note::orderBy('id', 'desc')->get();
      return view('note/index', array('module' => 'notas', 'notes' => $notes));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
      $bill = Bill::find($id);
      $variables = Variable::orderBy('value', 'asc')->get();

      $clients = Client::all();
      $brands = Brand::all();
      $contacts = Contact::all();
      $budget = $bill->budget;

      return view('note/new', array('module' => 'notas', 'bill' => $bill, 'budget' => $budget, 'clients' => $clients, 'brands' => $brands, 'contacts' => $contacts, 'variables' => $variables));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
      $note = new Note;

      $bill = Bill::find($id);
      $note->bill()->associate($bill);

      $note->description = $request->description;

      if ($note->save()) {
        return redirect('notas/detalle/' . $note->id)->with('status', array('kind' => '', 'message' => ''));
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
      $note = Note::find($id);
      $bill = $note->bill;
      $variables = Variable::orderBy('value', 'asc')->get();

      $clients = Client::all();
      $brands = Brand::all();
      $contacts = Contact::all();
      $budget = $bill->budget;

      return view('note/show', array('module' => 'notas', 'bill' => $bill, 'budget' => $budget, 'clients' => $clients, 'brands' => $brands, 'contacts' => $contacts, 'variables' => $variables, 'note' => $note));
    }

    /**
     * Display the specified resource in formar to print a docuemnt.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showPrint($id) {
      $note = Note::find($id);
      $bill = $note->bill;
			return view('note/print', array('bill' => $bill, 'note' => $note));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
