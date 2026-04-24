<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    
    // Secure against mass assignment natively
    protected $guarded = ['id'];

    public function agent() { return $this->belongsTo(Agent::class); }
    public function type() { return $this->belongsTo(PropertyType::class, 'property_type_id'); }
    public function status() { return $this->belongsTo(PropertyStatus::class, 'status_id'); }
    public function location() { return $this->hasOne(PropertyLocation::class); }
    public function images() { return $this->hasMany(PropertyImage::class)->orderBy('sort_order'); }
    public function documents() { return $this->hasMany(PropertyDocument::class); }
    public function features() { return $this->belongsToMany(Feature::class, 'property_features'); }
    public function floorPlans() { return $this->hasMany(PropertyFloorPlan::class); }
    public function offers() { return $this->hasMany(Offer::class); }
    public function inquiries() { return $this->hasMany(Inquiry::class); }
    public function appointments() { return $this->hasMany(Appointment::class); }
}