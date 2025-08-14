<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id', 
        'vpn_country', 
        'name', 
        'vpn_credentials_username', 
        'vpn_credentials_password', 
        'udp_configuration', 
        'tcp_configuration', 
        'access_type', 
        'status'
    ];
    
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
