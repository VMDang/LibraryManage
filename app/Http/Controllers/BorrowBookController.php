<?php

namespace App\Http\Controllers;

use App\Models\Shelf_Book;
use BaseHelper;
use Carbon\Carbon;
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

    public function updateIDforShowLocationAjax($id){
        try {
            $book_id = $id;
            $shelfs = Shelf_Book::with('book', 'shelf')->get();
            $array_shelf = [];

            foreach($shelfs as $shelf){
                if($book_id == $shelf->book->id){
                    array_push($array_shelf, $shelf->shelf->location);
                }
            }

            view("borrowbooks.create", compact('array_shelf'));
            BaseHelper::ajaxResponse(config('app.messageSaveSuccess'), true, $array_shelf);
        } catch (\Exception $e) {
            print($e);
            BaseHelper::ajaxResponse(config('app.messageSaveError'), false);
        }
        
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
        $message = [
            'book_id.required' => 'Hãy chọn một cuốn sách'
        ];

        $validated = $request->validate([
            'book_id' => 'required',
        ], $message);

        $borrowing = new Borrowing;
        $borrowing->user_id = Auth::id();
        $borrowing->book_id = $request->book_id;
        $borrowing->location = $request->book_location;
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
                    ->get(['users.name', 'users.gender', 'users.birthday', 'users.email', 'books.name as bookname', 'books.author',
                        'borrowings.borrow_date', 'borrowings.message_user', 'borrowings.id', 'borrowings.status',
                        'borrowings.due_date', 'borrowings.message_approver', 'borrowings.location' ]);

            $borrowInfo[0]->borrow_date = $this->changeFormatDateOutput($borrowInfo[0]->borrow_date);
            $borrowInfo[0]->due_date = $this->changeFormatDateOutput($borrowInfo[0]->due_date);
            $borrowInfo[0]->birthday = $this->changeFormatDateOutput($borrowInfo[0]->birthday);

            BaseHelper::ajaxResponse(config('app.messageGetSuccess'), true, $borrowInfo[0]);
        }catch(\Exception $e){
            print($e);
            BaseHelper::ajaxResponse(config('app.messageSaveError'), false);
        }
    }

    public function approveBorrowingAjax(Request $request){
        $this->checkRequestAjax($request);

        try{
            $borrowing = Borrowing::find($request->id);
            if ($request->input('borrow_date') == null){
                $borrowing->status = 2;
            }else {
                $borrowing->status = 1;
                $borrowing->borrow_date =$this->changeFormatDateInput( $request->input('borrow_date'));
                $borrowing->due_date = $this->changeFormatDateInput($request->input('due_date'));
                $borrowing->book->number -= 1;
                if($borrowing->book->number==0){
                    $borrowing->book->status = 0;
                } 
            }

            $borrowing->approved_by = Auth::id();
            $borrowing->message_approver = $request->message_approver;

            $borrowing->save();
            $borrowing->book->save();

            BaseHelper::ajaxResponse(config('app.messageSaveSuccess'), true);
        }catch(\Exception $e){
            print($e);
            BaseHelper::ajaxResponse(config('app.messageSaveError'), false);
        }
    }

}
