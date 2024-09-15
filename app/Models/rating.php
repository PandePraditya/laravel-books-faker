<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'rating',
        'voter',
    ];

    public function book()
    {
        return $this->belongsTo(book::class);
    }
}
