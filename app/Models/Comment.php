<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'req_id',
        'user_id',
        'commenter_id',
        'content',
        'is_read',
        'key',
        'created_at', 
        'updated_at'
    ];
    
    protected $table = 'tss_comments';
    
    public function user()
    {
        return $this->belongsTo(User::class, 'commenter_id', 'key');
    }
}
