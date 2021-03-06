<?php

namespace App\Http\Controllers;

use App\Hotel;
use App\Hotel_user;
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

        if ($request->has('city_name') && $request->has('country')) {
            $location = Location::firstOrCreate([
                'name' => $request->input('city_name'),
                'country' => $request->input('country')
            ]);
        }

        if ($request->has('user_id') &&
            $request->has('arrival_date') &&
            $request->has('departure_date') &&
            $request->has('price') &&
            $request->has('amount_persons') &&
            $request->has('paid') &&
            $request->has('bank_account_number')) {

            if ($request->has('hotel') &&
                $request->has('hotel.name') &&
                $request->has('hotel.road_name') &&
                $request->has('hotel.house_number') &&
                $request->has('hotel.zip_code')) {

                $hotel = Hotel::create([
                    'location_id' => $location->id,
                    'name' => $request->input('hotel.name'),
                    'road_name' => $request->input('hotel.road_name'),
                    'house_number' => $request->input('hotel.house_number'),
                    'zip_code' => $request->input('hotel.zip_code'),
                ]);
            }

            if (!isset($hotel)) {
                return response('Hotel not found', 404);
            }

            Hotel_user::create([
                'user_id' => $request->input('user_id'),
                'hotel_id' => $hotel->id,
                'arrival_date' => $request->input('arrival_date'),
                'departure_date' => $request->input('departure_date'),
                'price' => $request->input('price'),
                'amount_persons' => $request->input('amount_persons'),
                'paid' => $request->input('paid'),
                'back_account_number' => $request->input('bank_account_number')
            ]);

            return response('', 201);
        }
        return response('Failed', 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $userId
     * @param  int  $hotelId
     * @return \Illuminate\Http\Response
     */
    public function show($userId, $hotelId)
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
    public function update(Request $request, $userId, $hotelId)
    {
        if (isset($request['user_id']) &&
            isset($request['hotel_id']) &&
            isset($request['arrival_date']) &&
            isset($request['departure_date']) &&
            isset($request['price']) &&
            isset($request['amount_persons']) &&
            isset($request['paid']) &&
            isset($request['bank_account_number'])) {

            $hotel_user = Hotel_route::where([['user_id', $userId], ['hotel_id', $hotelId]])
            ->update([
                'route_id' => $request['user_id'],
                'hotel_id' => $request['hotel_id'],
                'arrival_date' => $request['arrival_date'],
                'departure_date' => $request['departure_date'],
                'price' => $request['price'],
                'amount_persons' => $request['amount_persons'],
                'paid' => $request['paid'],
                'bank_account_number' => $request['bank_account_number']
            ]);

            if (isset($request['hotels']) &&
                isset($request['hotels']['location_id']) &&
                isset($request['hotels']['name']) &&
                isset($request['hotels']['road_name']) &&
                isset($request['hotels']['house_number']) &&
                isset($request['hotels']['zip_code'])
            ) {
                Hotel::find($hotelId)->update([
                    'location_id' => $request['location_id'],
                    'name' => $request['name'],
                    'road_name' => $request['road_name'],
                    'house_number' => $request['house_number'],
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
