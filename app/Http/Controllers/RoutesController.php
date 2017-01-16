<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoutesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($userId)
    {
        return Route::where('user_id', $userId)->get();
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($userId, $routeId)
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $userId, $routeId)
    {
        //
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
        //
    }
}
