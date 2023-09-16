<?php

namespace App\Models;

use Facades\App\Clients\ClientFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retailer extends Model
{
    public function addstock(Product $product, Stock $stock)
    {

        $stock->product_id = $product->id;
        $this->Stock()->save($stock);
    }

    public function Stock (){
        return $this->hasMany(Stock::class);
    }

    public function client(){
        return ClientFactory::make($this);
    }

}
