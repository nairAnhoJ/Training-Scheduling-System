<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'table',
        'table_key',
        'action',
        'description',
        'field',
        'before',
        'after',
        'user_id',
        'created_at', 
        'updated_at'
    ];
    
    protected $table = 'tss_logs';
    
    public function user() {
        return $this->belongsTo(User::class);
    }
}
