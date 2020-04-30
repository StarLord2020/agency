<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $role = (new Role()) -> getRole($user->role_id);
        if($role[0]->name) {
            switch ($role[0]->name) {
                case'Работодатель':

                    $id=Auth::id();
                    $myBids=(new Bid())->getUserBid($id);
                    return view('employer.index',compact('myBids'));
                case'Работник':

                    return view('employee.index');
                case'Менеджер':

                    return view('manager.index');
            }
        }
    }
}
