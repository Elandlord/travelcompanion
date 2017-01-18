<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HotelApiController extends Controller
{

    public function getHotel($location){

        $url = "http://api.citygridmedia.com/content/places/v2/search/where?type=hotel&where=$location&publisher=10000018718";

        $response = file_get_contents($url);

        return $response;
    }
}
