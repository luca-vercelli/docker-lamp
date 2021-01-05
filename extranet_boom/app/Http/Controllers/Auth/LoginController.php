<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Where to redirect users after logout.
     *
     * @var string
     */
    // protected $redirectAfterLogout = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
        $this->validate($request, [
          'email' => 'required|email|max:255',
          'password' => 'required|min:6',
        ]);

        $email = $request->email;
        $password = $request->password;
        if (Auth::attempt(['email' => $email, 'password' => $password, 'status' => 1])) {
            // Authentication passed...

            // Get the user level
            $user = Auth::user();

            // Store the user level on session
            $request->session()->put('name', $user->name);
            // $avatar = ($user->image != '') ? $user->image : null;
            // $request->session()->put('avatar', $avatar);
            $request->session()->put('email', $email);
            $request->session()->put('avatar', $user->avatar);
            $request->session()->put('kind', $user->kind);

            return redirect()->intended('/home');
        } else {
          return redirect()->intended('/login');
        }
    }
}
