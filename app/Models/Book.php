<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'preview_content', 'file_book',
        'author', 'publisher', 'date_publication', 'cost', 'number', 'status',
        'created_by', 'updated_by', 'created_at', 'updated_at',
    ];
   
    
}
