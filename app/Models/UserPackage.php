<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPackage extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'package_id', 'package_duration', 'purchased_at', 'expires_at',];

    public function packagePricing()
    {
        return $this->belongsTo(PackagePricing::class, 'package_id', 'id');
    }

}
