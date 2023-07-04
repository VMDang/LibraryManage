<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'depcription', 'status',
        'created_by', 'updated_by', 'created_at', 'updated_at',
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_categories');
    }
}
