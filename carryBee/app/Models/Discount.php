<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = [
        'merchant_id', 'merchant_name','merchant_email', 'onboarding_date', 'phone',
        'pickup_hub', 'product_category', 'promised_parcels',
        'requirements', 'discount_rules','kma', 'is_active'
    ];

    protected $casts = [
        'requirements' => 'array',
        'discount_rules' => 'array',
    ];

     public function discountRates()
    {
        return $this->hasMany(DiscountRule::class);
    }
    public function rules()
{
    return $this->hasMany(DiscountRule::class);
}
    
    // Default rates as defined in your array
    public static function getDefaultRates()
    {
        return [
            'same_city' => [ '0-200' => 49, '201-500' => 60, '501-1000' => 70, '1001-1500' => 80, '1501-2000' => 90, '2001-2500' => 100, '2500+' => 20 ],
            'dhk_sub' => [ '0-200' => 80, '201-500' => 85, '501-1000' => 100, '1001-1500' => 120, '1501-2000' => 125, '2001-2500' => 135, '2500+' => 20 ],
            'dhk_outside' => [ '0-200' => 99, '201-500' => 105, '501-1000' => 125, '1001-1500' => 140, '1501-2000' => 150, '2001-2500' => 160, '2500+' => 25 ],
            'outside_dhk' => [ '0-200' => 99, '201-500' => 105, '501-1000' => 110, '1001-1500' => 125, '1501-2000' => 125, '2001-2500' => 150, '2500+' => 25 ],
            'outside_outside' => [ '0-200' => 125, '201-500' => 125, '501-1000' => 135, '1001-1500' => 145, '1501-2000' => 155, '2001-2500' => 165, '2500+' => 25 ],
        ];
    }
}
