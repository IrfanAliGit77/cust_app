<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    // Field yang boleh diisi (mass assignable)
    protected $fillable = [
        'name', 
        'code', 
        'address', 
        'city_id',
        'latitude',
        'longitude'
    ];

    // Relasi: Customer dimiliki oleh City
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
