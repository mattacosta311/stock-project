<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Retailer;
use App\Models\Stock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use SebastianBergmann\Type\VoidType;

class RetailerWithProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */


    public function run()
    {
        $switch = Product::create(['name' => 'Nintendo Switch']);

        $bestBuy = Retailer::create(['name' => 'Best Buy']);


        $bestBuy->addstock($switch, new Stock([
            'price' => 1000,
            'url' => 'http://foo.com',
            'sku' => 12345,
            'in_stock' => false
        ]));
    }
}
