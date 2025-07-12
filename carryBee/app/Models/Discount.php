<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = [
        'merchant_id', 'merchant_name','merchant_email', 'onboarding_date', 'phone',
        'pickup_hub', 'product_category', 'promised_parcels',
        'requirements', 'discount_rules'
    ];

    protected $casts = [
        'requirements' => 'array',
        'discount_rules' => 'array',
    ];
}
