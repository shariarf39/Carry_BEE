<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hub extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'location', 'contact_number', 'email', 'is_active',
    ];
}