<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;
    
    // Secure against mass assignment natively
    protected $guarded = ['id'];

    public function user() { return $this->belongsTo(User::class); }
    public function agency() { return $this->belongsTo(Agency::class); }
    public function properties() { return $this->hasMany(Property::class); }
    public function reviews() { return $this->hasMany(AgentReview::class); }
}