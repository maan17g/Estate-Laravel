<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentReview extends Model
{
    use HasFactory;
    
    // Secure against mass assignment natively
    protected $guarded = ['id'];

    public function agent() { return $this->belongsTo(Agent::class); }
    public function reviewer() { return $this->belongsTo(User::class, 'reviewer_id'); }
}