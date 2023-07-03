<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books_Category extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'books_categories';

    protected $fillable = [
        'id', 'book_id', 'category_id',
        'created_by', 'updated_by', 'created_at', 'updated_at',
    ];
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

}
