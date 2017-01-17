<?php

namespace App\Http\Controllers;

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
    public function index($userId, $routeId)
    {
        $route = Route::find($routeId);
        return $route->hotels();
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
        //
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
        //
    }
}
