<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::orderBy('name', 'asc')->get();
        return view('admin/user/index', array('module' => 'admin', 'sub_module' => 'user', 'users' => $users));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/user/new', array('module' => 'admin', 'sub_module' => 'user'));
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
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
            'kind' => 'required|numeric',
        ]);

        $user = new User;

        if ($request->hasFile('image')) {
          $imageName = strtolower(str_replace(' ', '', $request->email)) . '.' . $request->file('image')->getClientOriginalExtension();
          $request->file('image')->move('uploads/', $imageName);

          // open an image file
          $img = Image::make('uploads/' . $imageName);

          // now you are able to resize the instance
          $img->resize(48, 48);

          // finally we save the image as a new file
          $resizeImageName = strtolower(str_replace(' ', '', $request->name)) . '_48x48.' . $request->file('image')->getClientOriginalExtension();
          $img->save('uploads/' . $resizeImageName);
          $user->avatar = $resizeImageName;
        }

        $user->name = $request->name;
        $user->email = $request->email;

        // Check password field, if empty update the password
        if($request->password != ''){
            $user->password = bcrypt($request->password);
        }

        $user->kind = $request->kind;

        if ($user->save()) {
          return redirect('admin/usuarios')->with('status', array('kind' => 'success', 'message' => 'Usuario creado con &eacute;xito.'));
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
        $user = User::find($id);
        return view('admin/user/update', array('module' => 'admin', 'sub_module' => 'user', 'user' => $user));
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
          'email' => 'required|email',
          'password' => 'confirmed|min:6',
          'kind' => 'required|numeric',
          'status' => 'required|numeric',
      ]);

      $user = User::find($id);

      $user->name = $request->name;
      $user->email = $request->email;

      if ($request->hasFile('image')) {
        $imageName = strtolower(str_replace(' ', '', $request->email)) . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move('uploads/', $imageName);

        // open an image file
        $img = Image::make('uploads/' . $imageName);

        // now you are able to resize the instance
        $img->resize(48, 48);

        // finally we save the image as a new file
        $resizeImageName = strtolower(str_replace(' ', '', $request->name)) . '_48x48.' . $request->file('image')->getClientOriginalExtension();
        $img->save('uploads/' . $resizeImageName);
        $user->avatar = $resizeImageName;
      }

      // Check password field, if empty update the password
      if($request->password != ''){
          $user->password = bcrypt($request->password);
      }

      $user->kind = $request->kind;
      $user->status = $request->status;

      if ($user->save()) {
          // if the update is the logged user update session image
          if ($request->hasFile('image') && $request->session()->get('email') == $request->email) {
            $request->session()->put('avatar', $resizeImageName);
          }
          return redirect('admin/usuarios/actualizar/' . $user->id)->with('status', array('kind' => 'success', 'message' => 'Usuario actualizado con &eacute;xito.'));
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
