<?php

namespace Tests\Unit;

use App\Clients\ClientException;
use App\Models\Product;
use App\Models\Retailer;
use App\Models\Stock;
use Database\Seeders\RetailerWithProductSeeder;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StockTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function throws_an_exception_when_client_is_not_found_when_tracking()
    {
        //have a retailer with stock
        //prepare to find an exception
        //track 
        //if no client class for retailer throw exception

        $this->seed(RetailerWithProductSeeder::class);

        Retailer::first()->update(['name' => 'foo store']);

        $this->expectException(ClientException::class);

        Stock::first()->track();



        
    }
}
