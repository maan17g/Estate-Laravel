<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    use HasFactory;
    
    // Secure against mass assignment natively
    protected $guarded = ['id'];

    public function properties() { return $this->hasMany(Property::class); }
}