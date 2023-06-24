<?php

namespace App\Http\Controllers;

use BaseHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Borrowing;
use App\Models\Book;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

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


        return view("borrowbooks.create", compact('user', 'books'));
    }
    public function approve()
    {   
        if(Gate::any(['isAdmin', 'isMod'])){
            $user = Auth::user();
            $borrowings = Borrowing::with('user', 'book')->get();
            return view("borrowbooks.approve", compact('user', 'borrowings'));
        }else{
            abort(403, 'Bạn không có quyền truy cập trang này.');
        }
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

    public function history(){
        $user = Auth::user();
        $borrowings = Borrowing::with('user', 'book')->get();
        return view('borrowbooks.history', compact('user', 'borrowings'));
    }

    public function getBorrowingOfInfoAjax($id){
        try{
            $borrowInfo = DB::table('borrowings')   
                    ->join('users', 'borrowings.user_id', '=', 'users.id')
                    ->join('books', 'borrowings.book_id', '=', 'books.id')
                    ->where('borrowings.id', $id)
                    ->get(['users.name', 'users.gender', 'users.birthday', 'users.email', 'books.name', 'books.author', 'borrowings.*']);
            BaseHelper::ajaxResponse(config('app.messageGetSuccess'), true, $borrowInfo[0]);
        }catch(\Exception $e){
            print($e);
            BaseHelper::ajaxResponse(config('app.messageSaveError'), false);
        }   
    }

    public function approveBorrowingAjax(Request $request){
        try{
            $this->checkRequestAjax($request);
            $user = Auth::user();
            $borrowing = Borrowing::find($request->id);
            if ($request->date_borrow == null) {
                $borrowing->status = 1;
                $borrowing->approved_by = $user->name;
            }else{
                $borrowing->status = 1;
                $borrowing->approved_by = $user->name;
                $borrowing->borrow_date = $request->date_borrow;
                $borrowing->due_date = $request->due_date;
            }
            $borrowing->message_approver = $request->message_approver;

            $borrowing->save();

            return redirect()->route('borrow.approve');
        }catch(\Exception $e){
            print($e);
            BaseHelper::ajaxResponse(config('app.messageSaveError'), false);
        }
    }

}