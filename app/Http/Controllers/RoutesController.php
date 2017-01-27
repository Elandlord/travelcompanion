<?php

namespace App\Http\Controllers;

use App\Route;
use App\User;
use Illuminate\Http\Request;

class RoutesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        return Route::where('user_id', $user->id)->get();
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
    public function store(Request $request, $userId)
    {
        $departure_date = $request['departure_date'];
        $return_date = $request['return_date'];
        $name = $request['name'];

        if (isset($departure_date) && isset($return_date) && isset($name)) {
            Route::create([
                'name' => $name,
                'user_id' => $userId,
                'departure_date' => $departure_date,
                'return_date' => $return_date,
            ]);
            return response('', 201);
        }
        return response('', 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $userId
     * @param  int  $routeId
     * @return \Illuminate\Http\Response
     */
    public function show($userId, $routeId)
    {
        $route = Route::where('id', $routeId)->get();
        if (isset($route)) {
            return $route;
        }
        return response('', 404);
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
     * @param  int  $userId
     * @param  int  $routeId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $userId, $routeId)
    {
        $route = Route::find($routeId);
        if (isset($route) && !empty($route)) {
            if (isset($request['departure_date'])) {
                $route->departure_date = $request['departure_date'];
            }
            if (isset($request['return_date'])) {
                $route->return_date = $request['return_date'];
            }
            $route->save();
            return response('', 200);
        }
        return response('', 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $userId
     * @param  int  $routeId
     * @return \Illuminate\Http\Response
     */
    public function destroy($userId, $routeId)
    {
        $route = Route::find($routeId);
        if (isset($route) && !empty($route)) {
            $route->delete();
            return response('', 200);
        }
        return response('', 404);
    }
}
