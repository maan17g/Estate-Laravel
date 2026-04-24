<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;
    
    // Secure against mass assignment natively
    protected $guarded = ['id'];

    public function property() { return $this->belongsTo(Property::class); }
    public function inquirer() { return $this->belongsTo(User::class, 'inquirer_id'); }
    public function agent() { return $this->belongsTo(Agent::class); }
    public function responder() { return $this->belongsTo(User::class, 'responded_by'); }
}