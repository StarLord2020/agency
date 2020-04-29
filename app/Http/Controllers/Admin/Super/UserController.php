<?php

namespace App\Http\Controllers\Admin\Super;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;
use App\Models\Grade;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\User\StoreRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = (new User())
            ->getAll()
            ->get();

        return view('admin.super.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.super.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $response=(new User())->prepareFromCreate($request->all());

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        return view('admin.super.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, User $user)
    {
        $data = $request->only(['surname',
            'name',
            'patronymic',
            'email',
            'birthday',
            'sex',
            'role',
            'address',
            'number',
            'password',
            ]);


        if(isset($data['password'])&&$data['password'])
        {
            $data['password']=bcrypt($data['password']);
        }
        else {

            unset($data['password']);
        }

        $user->update($data);

        return ['response'=>'updated'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return ['response'=>'deleted'];
    }
}
