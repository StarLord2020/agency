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
                    return redirect('/employer/bid');
                case'Работник':

                    return redirect('/employee/employee-resume');
                case'Менеджер':

                    return redirect('/manager/bids');
            }
        }
    }
}
