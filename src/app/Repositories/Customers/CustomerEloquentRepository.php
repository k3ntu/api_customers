<?php

namespace App\Repositories\Customers;

use App\Models\Customer;

class CustomerEloquentRepository implements CustomerRepositoryInterface
{

    public function getCostumers(): array
    {
        return Customer::all()->toArray();
    }
}
