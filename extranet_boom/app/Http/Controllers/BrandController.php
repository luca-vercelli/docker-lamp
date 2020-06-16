<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
use App\Client;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $brands = Brand::orderBy('name', 'asc')->get();
        return view('admin/brand/index', array('module' => 'admin', 'sub_module' => 'brand', 'brands' => $brands));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all();
        return view('admin/brand/new', array('module' => 'admin', 'sub_module' => 'brand', 'clients' => $clients));
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

        $brand = new Brand;

        $brand->name = $request->name;
        $client = Client::find($request->client);
        $brand->client()->associate($client);

        if ($brand->save()) {
            return redirect('admin/marcas')->with('status', array('kind' => 'success', 'message' => 'Marca creada con &eacute;xito.'));
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
        $brand = Brand::find($id);
        $clients = Client::all();
        return view('admin/brand/update', array('module' => 'admin', 'sub_module' => 'brand', 'brand' => $brand, 'clients' => $clients));
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

        $brand = Brand::find($id);

        $brand->name = $request->name;
        $client = Client::find($request->client);
        $brand->client()->associate($client);

        if ($brand->save()) {
            return redirect('admin/marcas/actualizar/' . $brand->id)->with('status', array('kind' => 'success', 'message' => 'Marca actualizada con &eacute;xito.'));
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
