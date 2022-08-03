<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class barbers extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $table ="barbers";
    protected $fillable =['name', 'phone', 'address', 'password', 'image', 'image2', 'category_id'];

    public function barbersModel()
    {
        return $this->belongsTo(category::class, '', 'id');
    }

    public function posts()
    {
        return $this->hasMany(posts::class, 'barbers_id', 'id');
    }
}
