<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class users extends Authenticatable
{
    use Notifiable, HasApiTokens;
    
    protected $table ="barbers";
    protected $fillable =['name', 'age', 'email', 'password', 'address', 'phone'];

    public function payment()
    {
        return $this->hasMany(payment::class, 'user_id', 'id');
    }
}
