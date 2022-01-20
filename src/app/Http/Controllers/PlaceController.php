<?php

namespace App\Http\Controllers;

use App\Jobs\SearchLocation;
use App\Models\Customer;

class PlaceController extends Controller
{

    public function index()
    {

        $customers = Customer::where(['latitude' => 0])->get()->unique('city');

        if (count($customers) > 0) {
            foreach ($customers as $c)
            {
                SearchLocation::dispatchSync($c->city);
                //$this->search($c->city);
            }
        }
    }


}
