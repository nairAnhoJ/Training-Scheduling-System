<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'address', 
        'area', 
        'cp1_name', 
        'cp1_number', 
        'cp1_email', 
        'cp2_name', 
        'cp2_number', 
        'cp2_email', 
        'cp3_name', 
        'cp3_number', 
        'cp3_email', 
        'is_deleted', 
        'is_active', 
        'key', 
        'created_at', 
        'updated_at'
    ];
    
    protected $table = 'customers';
}
