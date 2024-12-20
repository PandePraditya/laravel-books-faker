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
        return $this->belongsTo(author::class); // Association with the 'author' model
    }

    public function category()
    {
        return $this->belongsTo(category::class); // Association with the 'category' model
    }

    public function ratings()
    {
        return $this->hasMany(rating::class); // Association with the 'rating' model
    }
}
