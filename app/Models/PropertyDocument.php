<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyDocument extends Model
{
    use HasFactory;
    
    // Secure against mass assignment natively
    protected $guarded = ['id'];

    public function property() { return $this->belongsTo(Property::class); }
    public function uploader() { return $this->belongsTo(User::class, 'uploaded_by'); }
}