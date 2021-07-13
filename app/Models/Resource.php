<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = ['name', 'resource', 'is_menu'];
    
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
