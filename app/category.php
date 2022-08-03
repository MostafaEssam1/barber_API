<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $table ="categories";
    protected $fillable =['name'];

    public function barbers()
    {
        return $this->hasMany(barbers::class, 'category_id', 'id');
    }
}
