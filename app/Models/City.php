<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    // Field yang boleh diisi (mass assignable)
    protected $fillable = ['name'];

    // Relasi: City memiliki banyak Customer
    public function customers()
    {
        return $this->hasMany(Customer::class, 'city_id');
    }
}
