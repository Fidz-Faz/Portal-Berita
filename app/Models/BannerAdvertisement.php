<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;


class BannerAdvertisement extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'link',
        'is_active',
        'type',
        'thumbnail'
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['link'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function news(): HasMany
    {
        return $this->hasmany(ArticleNews::class);
    }
}
