<?php

namespace Tests\Unit;

use App\Models\Retailer;
use Facades\App\Clients\ClientFactory;
use App\Clients\StockStatus;
use App\Models\History;
use App\Models\Product;
use App\Models\Stock;
use Database\Seeders\RetailerWithProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Client\Factory;
use Illuminate\Support\Facades\Http;
use Mockery\Mock;
use Tests\TestCase;

class ProductHistoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    function checks_product_history_is_stored_properly()
    {
        // given you have a product with stock
        $this->seed(RetailerWithProductSeeder::class);

        ClientFactory::shouldReceive('make->checkAvailability')
            ->andReturn(new StockStatus($available = true, $price = 99));


        $product = tap(Product::first(), function ($product) {
            $this->assertCount(0, $product->history);

            // if I track that product
            $product->track();

            // a new history entry should be made
            $this->assertCount(1, $product->refresh()->history);
        });

        $history = $product->history->first();
        $this->assertEquals($price, $history->price);
        $this->assertEquals($available, $history->in_stock);
        $this->assertEquals($product->id, $history->product_id);
        $this->assertEquals($product->stock[0]->id, $history->id);
    }
}
