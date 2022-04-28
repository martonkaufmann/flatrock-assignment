<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuestUser extends Model
{
    protected $fillable = ['email', 'first_name', 'last_name'];
}
