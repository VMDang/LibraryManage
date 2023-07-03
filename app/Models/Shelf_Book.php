<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shelf_Book extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'shelfs_books';
    protected $fillable = [
        'id', 'shelf_id', 'book_id',
        'created_by', 'updated_by', 'created_at', 'updated_at',
    ];
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
    public function shelf()
    {
        return $this->belongsTo(Shelf::class, 'shelf_id');
    }
}
