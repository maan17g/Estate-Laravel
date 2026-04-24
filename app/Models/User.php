<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $guarded = ['id'];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'last_login_at' => 'datetime',
            'two_factor_enabled' => 'boolean',
        ];
    }

    public function agent() { return $this->hasOne(Agent::class); }
    public function favorites() { return $this->belongsToMany(Property::class, 'favorites', 'customer_id', 'property_id'); }
    public function appointments() { return $this->hasMany(Appointment::class, 'customer_id'); }
    public function inquiries() { return $this->hasMany(Inquiry::class, 'inquirer_id'); }
    public function offers() { return $this->hasMany(Offer::class, 'buyer_id'); }
    public function transactions() { return $this->hasMany(Transaction::class); }
}