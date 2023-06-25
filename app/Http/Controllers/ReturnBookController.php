<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ReturnBook;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use BaseHelper;
use Illuminate\Support\Facades\DB;
class ReturnBookController extends Controller
{
     /**
     *Show the form for creating a new request return book.
     *@return  \Illuminate\Http\Response
      */
      
      public function create()
      {
          $user = Auth::user();
      
          $returnInfo = DB::table('borrowings')
              ->join('books', 'borrowings.book_id', '=', 'books.id')
              ->join('users', 'borrowings.user_id', '=', 'users.id')
              ->leftJoin('return_books', 'borrowings.id', '=', 'return_books.borrow_id')
              ->where('users.id', '=', Auth::id())
              ->select(
                  'users.name as user_name',
                  'users.email',
                  'return_books.borrow_id',
                  'return_books.message_user',
                  'return_books.message_mod',
                  'books.name as book_name',
                  'books.author',
                  'books.category_id',
                  'books.id as book_id',
                  'borrowings.message_user AS borrowing_message_user',
                  'borrowings.message_approver',
                  'borrowings.borrow_date'
              )
              ->get();
            
          $books = $returnInfo->pluck('book_name', 'book_id');
        return view("returnbooks.create", compact('user', 'books', 'returnInfo'));
      }

    public function approve()
      {
        return view("returnbooks.approve");
      }
    
    public function store(Request $request)
      {
        
        $ReturnBook                  = new ReturnBook;
        $ReturnBook->borrow_id       = $request->borrow_id;
        $ReturnBook->message_user    = $request->message_user;

        try {
          $ReturnBook->save();
          //  BaseHelper::ajaxResponse(config('app.messageSaveSuccess'),true);
          return redirect()->route('user.profile');
          
        } catch (\Exception $exception) {
            print_r($exception);
            BaseHelper::ajaxResponse(config('app.messageSaveError'), false);
        }
        
      }
      

    
}