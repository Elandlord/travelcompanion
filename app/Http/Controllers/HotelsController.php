<?php

namespace App\Http\Controllers;

use App\Hotel;
use App\Hotel_route;
use App\Location;
use App\User;
use App\Route;
use Illuminate\Http\Request;

class HotelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        // $hotel_route_collection = Hotel_route::where('route_id', $routeId)->get();
        // $hotel_collection = array();

        // foreach ($hotel_route_collection as $hotel_route) {
        //      array_push($hotel_collection, Hotel::find($hotel_route->hotel_id));
        // }

        // if (isset($hotel_route_collection) && isset($hotel_collection)) {
        //     $json_response = array();

        //     $i = 0;
        //     foreach ($hotel_route_collection as $hotel_route) {
        //         $json_response[$i] = $hotel_route['attributes'];
        //         $json_response[$i]['hotels'] =  $hotel_collection;
        //         $i += 1;
        //     }
        //     return response(json_encode($json_response))->header('Content-type', 'application/json');
        // }
        // return response('', 404);
        $hotels = $user->hotels; 
        return response()->json($hotels, 200);
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
        $hotel = null;
        $location = null;
        if (isset($request['city_name']) && isset($request['country'])) {
            $location = Location::firstOrCreate(['name' => $request['city_name'],
                                                'country' => $request['country']]);
        }

        if (isset($request['route_id']) &&
            isset($request['arrival_date']) &&
            isset($request['departure_date']) &&
            isset($request['price']) &&
            isset($request['amount_persons']) &&
            isset($request['paid']) &&
            isset($request['bank_account_number'])) {

            if (isset($request['hotel']) &&
                isset($request['hotel']['description']) &&
                isset($request['hotel']['name']) &&
                isset($request['hotel']['road_name']) &&
                isset($request['hotel']['house_number']) &&
                isset($request['hotel']['phone_number']) &&
                isset($request['hotel']['email_address']) &&
                isset($request['hotel']['zip_code'])) {
                $hotel = Hotel::create([
                    'location_id' => $location->id,
                    'description' => $request['hotel']['description'],
                    'name' => $request['hotel']['name'],
                    'road_name' => $request['hotel']['road_name'],
                    'house_number' => $request['hotel']['house_number'],
                    'phone_number' => $request['hotel']['phone_number'],
                    'email_address' => $request['hotel']['email_address'],
                    'zip_code' => $request['hotel']['zip_code'],
                ]);
            }

            if (!isset($hotel)) {
                return response('', 404);
            }

            Hotel_route::create([
                'route_id' => $request['route_id'],
                'hotel_id' => $hotel->id,
                'arrival_date' => $request['arrival_date'],
                'departure_date' => $request['departure_date'],
                'price' => $request['price'],
                'amount_persons' => $request['amount_persons'],
                'paid' => $request['paid'],
                'back_account_number' => $request['bank_account_number']
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
     * @param  int  $hotelId
     * @return \Illuminate\Http\Response
     */
    public function show($userId, $routeId, $hotelId)
    {
        $hotel_collection = Hotel::where('id', $hotelId)->get();
        $hotel_route_collection = Hotel_route::where('hotel_id', $hotelId)->get();

        $hotel = $hotel_collection[0]['attributes'];
        $hotel_route = $hotel_route_collection[0]['attributes'];

        if (isset($hotel) && isset($hotel_route)) {
            $json_response = $hotel_route;
            $json_response['hotels'] = $hotel;
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
     * @param  int  $userId
     * @param  int  $routeId
     * @param  int  $hotelId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $userId, $routeId, $hotelId)
    {
        if (isset($request['route_id']) &&
            isset($request['hotel_id']) &&
            isset($request['arrival_date']) &&
            isset($request['departure_date']) &&
            isset($request['price']) &&
            isset($request['amount_persons']) &&
            isset($request['paid']) &&
            isset($request['bank_account_number'])) {

            $hotel_route = Hotel_route::where([['route_id', $routeId], ['hotel_id', $hotelId]])
            ->update([
                'route_id' => $request['route_id'],
                'hotel_id' => $request['hotel_id'],
                'arrival_date' => $request['arrival_date'],
                'departure_date' => $request['departure_date'],
                'price' => $request['price'],
                'amount_persons' => $request['amount_persons'],
                'paid' => $request['paid'],
                'bank_account_number' => $request['bank_account_number']
            ]);

            if (isset($request['hotel']) &&
                isset($request['hotel']['location_id']) &&
                isset($request['hotel']['description']) &&
                isset($request['hotel']['name']) &&
                isset($request['hotel']['road_name']) &&
                isset($request['hotel']['house_number']) &&
                isset($request['hotel']['phone_number']) &&
                isset($request['hotel']['email_address']) &&
                isset($request['hotel']['zip_code'])
            ) {
                Hotel::find($hotelId)->update([
                    'location_id' => $request['location_id'],
                    'description' => $request['description'],
                    'name' => $request['name'],
                    'road_name' => $request['road_name'],
                    'house_number' => $request['house_number'],
                    'phone_number' => $request['phone_number'],
                    'email_address' => $request['email_address'],
                    'zip_code' => $request['zip_code']
                ]);
            }

            return response('', 200);
        }

        return response('', 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $userId
     * @param  int  $routeId
     * @param  int  $hotelId
     * @return \Illuminate\Http\Response
     */
    public function destroy($userId, $routeId, $hotelId)
    {
        $hotel = Hotel::find($hotelId);
        if (isset($hotel) && !empty($hotel)) {
            $hotel->delete();
            return response('', 200);
        }
        return response('', 404);
    }
}
