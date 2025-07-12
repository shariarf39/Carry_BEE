<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscountRule extends Model
{
    protected $fillable = [
        'discount_id', 'region', 'weight_range', 'discounted_rate', 'return_charge', 'cod'
    ];

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }
}
