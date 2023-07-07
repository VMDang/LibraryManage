<?php

namespace App\Http\Controllers\book;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BorrowBook;
use App\Models\Books_Shelves;
use BaseHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            $shelves = Books_Shelves::with('book', 'shelf')->get();
            $array_shelf = [];

            foreach($shelves as $shelf){
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
            $borrowBooks = BorrowBook::with('user', 'book')->get();
            return view("borrowbooks.approve", compact('user', 'borrowBooks'));
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
            'book_id.required' => 'Hãy chọn một cuốn sách',
            'book_location.required' => 'Hãy chọn một vị trí'
        ];

        $validated = $request->validate([
            'book_id' => 'required',
            'book_location' => 'required'
        ], $message);

        $borrowing = new BorrowBook;
        $borrowing->user_id = Auth::id();
        $borrowing->book_id = $request->book_id;
        $borrowing->location = $request->book_location;
        $borrowing->message_user = $request->message_user;
        try{
            $borrowing->save();
            return redirect()->route('history.history');
        }catch(\Exception $e){
            print($e);
            BaseHelper::ajaxResponse(config('app.messageSaveError'), false);
        }
    }

    public function getBorrowingOfInfoAjax($id){
        try{
            $borrowInfo = DB::table('borrow_books')
                    ->join('users', 'borrow_books.user_id', '=', 'users.id')
                    ->join('books', 'borrow_books.book_id', '=', 'books.id')
                    ->where('borrow_books.id', $id)
                    ->get(['users.name', 'users.gender', 'users.birthday', 'users.email', 'books.name as bookname', 'books.author',
                        'borrow_books.borrow_date', 'borrow_books.message_user', 'borrow_books.id', 'borrow_books.status', 'borrow_books.borrow_date',
                        'borrow_books.due_date', 'borrow_books.message_approver', 'borrow_books.location' ]);

            BaseHelper::ajaxResponse(config('app.messageGetSuccess'), true, $borrowInfo[0]);
        }catch(\Exception $e){
            print($e);
            BaseHelper::ajaxResponse(config('app.messageSaveError'), false);
        }
    }

    public function approveBorrowingAjax(Request $request){
        $this->checkRequestAjax($request);

        try{
            $borrowing = BorrowBook::find($request->id);
            if ($request->input('btn') == 2){
                $borrowing->status = 2;
            }else if ($request->input('btn') == 1){
                $borrowing->status = 1;
                $borrowing->borrow_date = $request->input('borrow_date');
                $borrowing->due_date = $request->input('due_date');
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
