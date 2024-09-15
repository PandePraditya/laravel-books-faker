<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author_id',
        'category_id',
    ];

    public function author()
    {
        return $this->belongsTo(author::class);
    }

    public function category()
    {
        return $this->belongsTo(category::class);
    }

    public function ratings()
    {
        return $this->hasMany(rating::class);
    }
}
