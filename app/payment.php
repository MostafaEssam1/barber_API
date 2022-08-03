<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    protected $table ="payment";
    protected $fillable =['post_id', 'user_id', 'data'];


    public function users()
    {
        return $this->belongsTo(users::class, '', 'id');
    }

    public function posts()
    {
        return $this->belongsTo(posts::class, '', 'id');
    }
}
