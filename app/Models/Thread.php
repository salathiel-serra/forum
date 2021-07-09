<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $fillable = ["title", "body"];
    
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
