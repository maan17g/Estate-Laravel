<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    
    // Secure against mass assignment natively
    protected $guarded = ['id'];

    public function user() { return $this->belongsTo(User::class); }
}