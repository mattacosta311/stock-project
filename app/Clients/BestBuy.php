<?php

namespace App\Clients;

use App\Clients\StockStatus;
use App\Models\Stock;
use Illuminate\Support\Facades\Http;

class BestBuy implements Clients {

    public function checkAvailability(Stock $stock): StockStatus
    {
        $results = Http::get($this->endpoint($stock->sku))->json();

        return new StockStatus(
            $results['onlineAvailability'],
            (int)($results['salePrice'] * 100)
        );
    }

    protected function endpoint($sku): string
    {
        $key = config('services.clients.bestBuy.key');
        return "https://api.bestbuy.com/v1/products/{$sku}.json?show=onlineAvailability,salePrice&apiKey={$key}";
    }
}
