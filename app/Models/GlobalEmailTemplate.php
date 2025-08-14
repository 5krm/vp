<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlobalEmailTemplate extends Model
{
    use HasFactory;
    
    protected $fillable = ['email_header', 'email_footer'];
}
