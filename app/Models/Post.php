<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/** @var $visit*/
class Post extends Model
{

    use HasFactory;
    protected $fillable=[
        'title',
        'text',
        'img',
        'biggerImg',
        'position',
        'created_at',
        'url',
    ];

    public function source_url(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(SourceUrl::class);
    }

    public function categories(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_post');
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }


    public function scopePosition($query, $position)
    {
        return $query->where('position', $position);
    }

    public function scopeActiveCategory($query)
    {
        return $query->where('status', 'active');
    }

    public function likes(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Like::class,'likeable');
    }


}
