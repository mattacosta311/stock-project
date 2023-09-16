<?php

namespace App\Models;

use App\Clients\BestBuy;
use App\Clients\ClientException;
use App\Clients\ClientFactory;
use App\Clients\Target;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Stock extends Model
{
    use HasFactory;

    protected $casts = [
        'in_stock' => 'boolean'
    ];

    // protected $table = 'stocks';

    public function track($callback = null)
    {

        // Hit an API for associated retailer
        // Fetch up-to-date data
        // refresh current stock with data

        // $class = ClientFactory()->make($this->retailer);
        $status = $this->retailer
            ->client()
            ->checkAvailability($this);

        $this->update([
            'in_stock' => $status->available,
            'price' => $status->price
        ]);

        $callback && $callback($this);

    }

    public function retailer()
    {
        return $this->belongsTo(Retailer::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }


}
