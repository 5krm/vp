<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
{
    use HasFactory;

    protected $fillable = ['login_system_type', 'faq_url', 'contact_us_url', 'privacy_policy_url', 'terms_and_conditions_url'];
}
