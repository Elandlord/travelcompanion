<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Not needed
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request['name'];
        $email = $request['email'];
        $password = $request['password'];
        if (isset($name) && isset($email) && isset($password)) {
            User::create([
                'name' => $name,
                'email' => $email,
                'password' => $password,
            ]);
            return response('', 201);
        }
        return response('', 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Not needed
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
        $user = User::find($id);
        if (isset($user) && !empty($user)) {
            if (isset($request['name'])) {
                $user->name = $request['name'];
            }
            if (isset($request['email'])) {
                $user->email = $request['email'];
            }
            if (isset($request['password'])) {
                $user->password = bcrypt($request['password']);
            }
            $user->save();
            return response('', 200);
        }
        return response('', 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if (isset($user) && !empty($user)) {
            $user->delete();
            return response('', 200);
        }
        return response('', 404);
    }
}
