<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    
    // Secure against mass assignment natively
    protected $guarded = ['id'];

    public function property() { return $this->belongsTo(Property::class); }
    public function customer() { return $this->belongsTo(User::class, 'customer_id'); }
    public function agent() { return $this->belongsTo(Agent::class); }
}