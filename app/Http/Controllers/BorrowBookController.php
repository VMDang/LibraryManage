<?php

namespace App\Http\Controllers;

use BaseHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Borrowing;
use App\Models\Book;

class BorrowBookController extends Controller
{
    /**
     * Show the form for creating a new request borrow book.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $books = Book::all();


        return view("borrowbooks.create", compact('user', 'books') );
    }
    public function approve()
    {
        $user = Auth::user();
        $borrowings = Borrowing::with('user', 'book')->get();
        return view("borrowbooks.approve", compact('user', 'borrowings'));
    }

    /**
     *
     * @param mixed $name
     */
    public function store(Request $request)
    {
        $borrowing = new Borrowing;
        $borrowing->user_id = Auth::id();
        $borrowing->book_id = $request->book_id;
        $borrowing->message_user = $request->message_user;
        try{
            $borrowing->save();
            return redirect()->route('borrow.create');
        }catch(\Exception $e){
            print($e);
            BaseHelper::ajaxResponse(config('app.messageSaveError'), false);
        }
    }

    // public function update(Request $request, $borrowing_id)
    // {
    //     $borrowing = Borrowing::find($borrowing_id);
    //     $borrowing->borrow_date = $request->borrow_date;
    //     $borrowing->due_date = $request->due_date;
    //     $borrowing->approved_by = $request->approved_by;
    //     $borrowing->message_approver = $request->message_approver;
    //     $borrowing->status = $request->status;
    //     try{
    //         $borrowing->save();
    //         return redirect()->route('borrow.approve');
    //     }catch(\Exception $e){
    //         print($e);
    //         BaseHelper::ajaxResponse(config('app.messageSaveError'), false);
    //     }
    // }

    public function history(){
        $user = Auth::user();
        $borrowings = Borrowing::with('user', 'book')->get();
        return view('borrowbooks.history', compact('user', 'borrowings'));
    }

}
