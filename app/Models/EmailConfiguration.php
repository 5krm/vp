<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailConfiguration extends Model
{
    use HasFactory;
    
    protected $fillable = ['email_send_method', 'mail_host', 'mail_port', 'mail_encryption_method', 'mail_username', 'mail_password', 'mail_from_address', 'mail_from_name'];
}
