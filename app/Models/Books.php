<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id', 'shelf_id', 'title', 'preview_content', 'file_book',
        'author', 'publisher', 'date_publication', 'cost', 'number', 'status',
        'created_by', 'updated_by', 'created_at', 'updated_at',
    ];
}
