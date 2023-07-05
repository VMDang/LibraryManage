<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shelf extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'shelfs';
    protected $fillable = [
        'id', 'location', 'status',
        'created_by', 'updated_by', 'created_at', 'updated_at',
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'shelf_books');
    }

}
