<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comment extends Model
{
    protected $fillable = ['user_id', 'content'];

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }
}
