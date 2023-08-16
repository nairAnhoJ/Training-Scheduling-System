<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerRequest extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'address',
        'cp1_name',
        'cp1_number',
        'cp1_email',
        'cp2_name',
        'cp2_number',
        'cp2_email',
        'cp3_name',
        'cp3_number',
        'cp3_email',
        'category',
        'brand',
        'model',
        'unit_type',
        'no_of_unit',
        'no_of_attendees',
        'knowledge_of_participants',
        'is_decline',
        'created_at', 
        'updated_at'
    ];
    
    protected $table = 'tss_customer_requests';
}
