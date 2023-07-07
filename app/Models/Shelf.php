<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shelf extends Model
{
    use HasFactory;

    protected $table = 'shelves';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'location', 'status',
        'created_by', 'updated_by', 'created_at', 'updated_at',
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'books_shelves');
    }

}
