<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;
    
    // Secure against mass assignment natively
    protected $guarded = ['id'];

    public function property() { return $this->belongsTo(Property::class); }
    public function user() { return $this->belongsTo(User::class); }
    public function paymentSchedules() { return $this->hasMany(RentalPaymentSchedule::class); }
}