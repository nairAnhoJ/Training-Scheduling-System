<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $fillable = [
        'number', 
        'customer_id', 
        'category', 
        'unit_type', 
        'brand', 
        'model', 
        'no_of_unit', 
        'billing_type', 
        'is_PM', 
        'contract_details', 
        'no_of_attendees', 
        'venue', 
        'training_date', 
        'knowledge_of_participants', 
        'trainer', 
        'remarks', 
        'status', 
        'key', 
        'created_at', 
        'updated_at', 
        'is_deleted'
    ];
    
    protected $table = 'tss_requests';

    use HasFactory;
}
