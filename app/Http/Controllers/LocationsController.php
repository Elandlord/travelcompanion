<?php

namespace App\Http\Controllers;

use App\Route;
use App\Location_route;
use App\Location;
use Illuminate\Http\Request;

class LocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  int  $routeId
     * @return \Illuminate\Http\Response
     */
    public function index(Route $route)
    {
        $locations = $route->locations;
        return response()->json($locations, 200);
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
        if (isset($request['location_id']) &&
            isset($request['route_id']) &&
            isset($request['arrival_date']) &&
            isset($request['departure_date'])) {

            if (isset($request['location']) &&
                isset($request['location']['name']) &&
                isset($request['location']['country'])) {
                Location::create([
                    'name' => $request['location']['name'],
                    'country' => $request['location']['country'],
                ]);
            }

            Location_route::create([
                'location_id' => $request['location_id'],
                'route_id' => $request['route_id'],
                'arrival_date' => $request['arrival_date'],
                'departure_date' => $request['departure_date'],
            ]);
            return response('', 201);
        }
        return response('', 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $locationId
     * @return \Illuminate\Http\Response
     */
    public function show($userId, $routeId, $locationId)
    {
        $location_collection = Location::where('id', $locationId)->get();
        $location_route_collection = Location_route::where('location_id', $locationId)->get();

        $location = $location_collection[0]['attributes'];
        $location_route = $location_route_collection[0]['attributes'];

        if (isset($location) && isset($location_route)) {
            $json_response = $location_route;
            $json_response['locations'] = $location;
            return response(json_encode($json_response))->header('Content-type', 'application/json');
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
     * @param  int  $routeId
     * @param  int  $locationId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $userId, $routeId, $locationId)
    {
        $location_route_set = false;
        $location_set = false;

        if (isset($request['location_id']) &&
            isset($request['route_id']) &&
            isset($request['arrival_date']) &&
            isset($request['departure_date'])) {

            $location_route = Location_route::where([['location_id', $locationId], ['route_id', $routeId]])
                ->update([
                    'location_id' => $request['location_id'],
                    'route_id' => $request['route_id'],
                    'arrival_date' => $request['arrival_date'],
                    'departure_date' => $request['departure_date'],
                ]);
            $location_route_set = true;
        }

        if (isset($request['location']) &&
            isset($request['location']['name']) &&
            isset($request['location']['country'])) {
            Location::find($locationId)->update([
                'location_id' => $request['location_id'],
                'description' => $request['description'],
                'name' => $request['name'],
                'road_name' => $request['road_name'],
                'house_number' => $request['house_number'],
                'phone_number' => $request['phone_number'],
                'email_address' => $request['email_address'],
                'zip_code' => $request['zip_code']
            ]);

            $location_set = true;
        }

        if ($location_route_set || $location_set) {
            return response('', 200);
        } else {
            return response('', 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $locationId
     * @return \Illuminate\Http\Response
     */
    public function destroy($userId, $routeId, $locationId)
    {
        $location = Location::find($locationId);
        if (isset($location) && !empty($location)) {
            $location->delete();
            return response('', 200);
        }
        return response('', 404);
    }
}
