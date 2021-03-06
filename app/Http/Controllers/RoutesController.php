<?php

namespace App\Http\Controllers;

use App\Route;
use App\User;
use Illuminate\Http\Request;
use App\Location;

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
    public function store(Request $request, $routeId)
    {
      $data = json_decode($request->input('data')['json']);

      $route = new Route();

      $route->name = $data->name;;
      $route->departure_date = $data->departure_date;;
      $route->return_date = $data->return_date;
      $route->user_id = $routeId;
      $route->save();

        foreach ($data->location as $value) {

        $location = Location::where('name', $value)->first();

        if(!empty($location->id)){
            $location = Location::find($location->id);
            $location->routes()->attach($route);
        }else{
            $location = new Location();
            $location->name = $value;
            $location->save();
            $location->routes()->attach($route);
        }

      }
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

?>
