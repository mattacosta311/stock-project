<?php

namespace App\Clients;
use App\Models\Stock;

interface Clients{
    public function checkAvailability(Stock $stock): StockStatus;
}