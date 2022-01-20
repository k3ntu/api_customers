<?php

namespace App\Console\Commands;

use App\Http\Controllers\HomeController;
use App\Jobs\SearchLocation;
use App\Models\Customer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;

class InitBoot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init:project';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize project with data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->startImportData();

        $customers = Customer::where(['latitude' => 0])->get()->unique('city');

        //Artisan::queue('queue:work');

        $this->comment('Call google apis by get geolocation!');
        if (count($customers) > 0) {
            foreach ($customers as $c)
            {
                SearchLocation::dispatchSync($c->city);
            }
        }

        $this->comment('Finished!!!');

        return 0;
    }

    public function startImportData()
    {
        $this->comment('Init imported data of customers.csv');

        $controller = new HomeController();

        $controller->bootImport();

        $this->comment('Data imported successfully');
    }
}
