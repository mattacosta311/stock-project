<?php

namespace App\Clients;
use App\Models\Stock;

class Target implements Clients{

    public function checkAvailability(Stock $stock){
        return New StockStatus;
    }
}