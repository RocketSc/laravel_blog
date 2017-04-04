<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['name', 'email', 'comment'];

    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    public function approve()
    {
        $this->approved = true;

        return $this;
    }
}
