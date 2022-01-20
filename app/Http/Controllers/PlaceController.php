<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apiKey = env('API_GOOGLE_MAPS_KEY');

        $address = 'Warner, NH';
        $prepAddr = str_replace(' ','+',$address);
        $geocode = file_get_contents('https://maps.google.com/maps/api/geocode/json?address=' . $prepAddr. '&sensor=false&key=' . $apiKey);
        $output= json_decode($geocode, true);

        $latitude = $output['results'][0]['geometry']['location']['lat'];
        $longitude = $output['results'][0]['geometry']['location']['lng'];

        $place = new Place();

        $place->name = $address;
        $place->latitude = $latitude;
        $place->longitude = $longitude;

        $place->save();

        return response()->json([
            'message' => 'create',
            'data' => $place
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function show(Place $place)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function edit(Place $place)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Place $place)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function destroy(Place $place)
    {
        //
    }
}
