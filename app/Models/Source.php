<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    use HasFactory;
    public function source_urls(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(SourceUrl::class);
    }
}
