<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    
    // Secure against mass assignment natively
    protected $guarded = ['id'];

    public function property() { return $this->belongsTo(Property::class); }
    public function buyer() { return $this->belongsTo(User::class, 'buyer_id'); }
}