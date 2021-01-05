<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Variable;

class VariableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $variables = Variable::orderBy('id', 'asc')->get();
        return view('admin/variable/index', array('module' => 'admin', 'sub_module' => 'vars', 'variables' => $variables));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/variable/new', array('module' => 'admin', 'sub_module' => 'vars'));
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
          'name' => 'required|max:10',
          'value' => 'required'
      ]);

      $variable = new Variable;

      $variable->name = $request->name;
      $variable->value = $request->value;

      if ($variable->save()) {
          return redirect('admin/variables')->with('status', array('kind' => 'success', 'message' => 'Variable creada con &eacute;xito.'));
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
      $variable = Variable::find($id);
      return view('admin/variable/update', array('module' => 'admin', 'sub_module' => 'vars', 'variable' => $variable));
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
        'name' => 'required|max:10',
        'value' => 'required'
      ]);

      $variable = Variable::find($id);

      $variable->name = $request->name;
      $variable->value = $request->value;

      if ($variable->save()) {
        return redirect('variables/actualizar/' . $variable->id)->with('status', array('kind' => 'success', 'message' => 'Variable actualizada con &eacute;xito.'));;
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
