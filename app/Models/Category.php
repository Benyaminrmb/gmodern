<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'status'
    ];
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'category_post');
    }
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
