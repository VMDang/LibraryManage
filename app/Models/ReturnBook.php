<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnBook extends Model
{
    use HasFactory;

    protected $table = 'return_books';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'borrow_id','date_return','status','approve_status','approved_by','created_at','updated_at',

   ];
   public function borrow_id()
   {
       return $this->belongsTo(BorrowBook::class, 'borrow_id');
   }
}
