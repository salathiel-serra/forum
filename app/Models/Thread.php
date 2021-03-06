<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $fillable = ["title", "body", "slug", "channel_id"];
    
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class, 'thread_id', 'id')->orderBy('created_at', 'DESC');
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
}
