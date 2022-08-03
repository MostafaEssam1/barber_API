<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class admin extends Authenticatable
{
    use Notifiable, HasApiTokens;
    
    protected $table ="admins";
    protected $fillable =['name', 'email', 'password', 'jop', 'image'];
}
