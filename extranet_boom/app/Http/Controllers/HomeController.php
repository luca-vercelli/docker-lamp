<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Budget;
use App\Bill;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $budgets = Budget::orderBy('updated_at', 'desc')->limit(10)->get();
        $bills = Bill::orderBy('updated_at', 'desc')->limit(10)->get();
        return view('home', array('module' => '', 'budgets' => $budgets, 'bills' => $bills));
    }
}
