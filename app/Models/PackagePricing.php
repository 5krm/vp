<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackagePricing extends Model
{
    use HasFactory;
    
    protected $fillable = ['package_name', 'product_id', 'package_duration', 'package_price', 'status'];

    public function userPackages()
    {
        return $this->hasMany(UserPackage::class, 'package_id');
    }
}
