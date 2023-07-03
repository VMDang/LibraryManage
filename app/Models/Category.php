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
<<<<<<< HEAD
   
=======

>>>>>>> 43f457e7d921d5358d8c438abda2df53eae3a71e
}
