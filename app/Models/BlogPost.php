<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;
    
    // Secure against mass assignment natively
    protected $guarded = ['id'];

    public function author() { return $this->belongsTo(User::class, 'author_id'); }
    public function category() { return $this->belongsTo(BlogCategory::class, 'category_id'); }
}