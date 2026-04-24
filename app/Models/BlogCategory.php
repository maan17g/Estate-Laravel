<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;
    
    // Secure against mass assignment natively
    protected $guarded = ['id'];

    public function posts() { return $this->hasMany(BlogPost::class, 'category_id'); }
}