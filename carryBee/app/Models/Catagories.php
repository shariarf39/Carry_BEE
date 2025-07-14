<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catagories extends Model
{
    // Table name if not standard plural form of model (optional here)
    protected $table = 'catagorieshub';

    // Primary key type
    protected $keyType = 'int';

    // If your primary key is auto-incrementing (default true)
    public $incrementing = true;

    // Timestamp fields are managed automatically (default true)
    public $timestamps = true;

    // Fillable fields for mass assignment
    protected $fillable = [
        'name',
    ];
}
