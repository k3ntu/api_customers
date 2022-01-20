<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function bootImport()
    {
        $csv = [];
        $filename = public_path('customers.csv');
        $fileHandle = fopen($filename, 'r');

        while (($customer = fgetcsv($fileHandle, 0, ',')) !== false) {
            $csv[] = array(
                'id' => (int) $customer[0],
                'first_name' => $customer[1],
                'last_name' => $customer[2],
                'email' => $customer[3],
                'gender' => $customer[4],
                'company' => $customer[5],
                'city' => $customer[6],
                'title' => $customer[7]
            );
        }

        fclose($fileHandle);

        unset($csv[0]);

        foreach ($csv as $customer)
        {
            Customer::create($customer);
        }

        return response()->json([
            'data' => $csv
        ]);
    }
}
