<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;
    
    // Secure against mass assignment natively
    protected $guarded = ['id'];

    public function customer() { return $this->belongsTo(User::class, 'customer_id'); }
}