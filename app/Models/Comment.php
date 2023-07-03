<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'req_id',
        'user_id',
        'commenter_id',
        'content',
        'is_read',
        'key'
    ];

    use HasFactory;
}
