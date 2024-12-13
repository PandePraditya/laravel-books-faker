<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function book()
    {
        return $this->hasMany(book::class); // Association with the 'book' model, hasMany in sql is the many in one to many
    }
}