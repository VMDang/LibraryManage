<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ReturnBook;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use BaseHelper;

class ReturnBookController extends Controller
{
     /**
     *Show the form for creating a new request return book.
     *@return  \Illuminate\Http\Response
      */
      
    public function create()
      {
        // $id_tmp = 2;
        // $user_tmp = User::find($id_tmp);
        $borrow_id = 1;
        $user = Auth::user();
        $book_id = 1;      
        $book = Book::find($book_id);
        // dd($book);
        
      return view("returnbooks.create" , compact('user' ,'book', 'borrow_id'));
        

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