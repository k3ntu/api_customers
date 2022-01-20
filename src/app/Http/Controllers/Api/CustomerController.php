<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Repositories\Customers\CustomerRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function response;

class CustomerController extends Controller
{
    /*public function __construct()
    {
        $this->middleware('auth:api');
    }*/

    public function index(CustomerRepositoryInterface $customer)
    {
        $customers = Customer::all();

        return response()->json([
            'message' => 'Retrieved successfully',
            'status' => 200,
            'error' => false,
            'data_error' => '',
            'data' => $customers,
        ], 200);
    }


    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'email' => 'required|email|unique:customers',
            'gender' => 'required|max:20',
            'company' => 'required|max:150',
            'city' => 'required|max:100',
            'title' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed.',
                'status' => 400,
                'error' => true,
                'data_error' => $validator->errors(),
                'data' => '',
            ], 400);
        }

        $customer = Customer::create($data);

        return response()->json([
            'message' => 'Customers created',
            'status' => 201,
            'error' => false,
            'data_error' => '',
            'data' => new CustomerResource($customer),
        ], 201);
    }


    public function show(Customer $customer)
    {
        return response()->json([
            'message' => 'Customer retrieved',
            'status' => 200,
            'error' => false,
            'data_error' => '',
            'data' => new CustomerResource($customer),
        ], 200);
    }


    public function update(Request $request, Customer $customer)
    {
        $customer->update($request->all());

        return response()->json([
            'message' => 'Customers updated',
            'status' => 200,
            'error' => false,
            'data_error' => '',
            'data' => new CustomerResource($customer),
        ], 200);
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return response()->json([
            'message' => 'Customers deleted',
            'status' => 200,
            'error' => false,
            'data_error' => '',
            'data' => $customer->id,
        ], 200);
    }
}
