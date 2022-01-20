<?php

namespace App\Jobs;

use App\Models\Customer;
use App\Models\Place;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class SearchLocation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $address;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($address)
    {
        $this->address = $address;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $place = Place::where(['name' => $this->address])->get();

        if (count($place) > 0) {
            Customer::where(['city' => $this->address])->update([
                'latitude' => $place[0]->latitude,
                'longitude' => $place[0]->longitude
            ]);
        } else {
            $apiKey = env('API_GOOGLE_MAPS_KEY');

            $prepAddr = str_replace(' ','+', $this->address);

            $response = Http::get('https://maps.google.com/maps/api/geocode/json?address=' . $prepAddr . '&sensor=false&key=' . $apiKey);

            $output= json_decode($response, true);

            if (count($output['results']) > 0) {
                $latitude = $output['results'][0]['geometry']['location']['lat'];
                $longitude = $output['results'][0]['geometry']['location']['lng'];

                $place = new Place();

                $place->name = $this->address;
                $place->latitude = $latitude;
                $place->longitude = $longitude;

                $place->save();

                Customer::where(['city' => $this->address])->update([
                    'latitude' => $place->latitude,
                    'longitude' => $place->longitude
                ]);
            }
        }


    }
}
