<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model {
    protected $fillable = [
        'number',
        'customer_id',
        'type',
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
        'plan_start_date',
        'plan_end_date',
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

    public function customer() {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function trainerName() {
        return $this->belongsTo(User::class, 'trainer');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'req_id', 'key');
    }

    use HasFactory;
}
