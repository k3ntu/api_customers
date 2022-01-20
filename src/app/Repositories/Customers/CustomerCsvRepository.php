<?php

namespace App\Repositories\Customers;

class CustomerCsvRepository implements CustomerRepositoryInterface
{

    public function getCostumers(): array
    {
        $csv = [];
        $filename = 'customers.csv';
        $fileHandle = fopen($filename, 'r');

        while (($customer = fgetcsv($fileHandle, 0, ',')) !== false) {
            $csv[] = $customer;
        }

        fclose($fileHandle);

        unset($csv[0]);

        return $csv;
    }
}
