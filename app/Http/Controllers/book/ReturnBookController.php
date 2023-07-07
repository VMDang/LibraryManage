<?php

namespace App\Http\Controllers\book;

use App\Http\Controllers\Controller;
use App\Models\ReturnBook;
use BaseHelper;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReturnBookController extends Controller
{
    /**
     *Show the form for creating a new request return book.
     * @return  Response
     */

    public function create()
    {
        $user = Auth::user();

        $returnInfo = DB::table('borrow_books')
            ->join('books', 'borrow_books.book_id', '=', 'books.id')
            ->join('users', 'borrow_books.user_id', '=', 'users.id')
            ->where('users.id', '=', Auth::id())
            ->where('borrow_books.status', '=', 1)
            ->select(
                'books.name as book_name',
                'books.author',
                'books.id as book_id',
                'borrow_books.id as borrow_id',
            )
            ->get();

        $returned = DB::table('borrow_books')
            ->join('return_books', 'return_books.borrow_id', '=', 'borrow_books.id')
            ->where('return_books.approve_status', '=', 1)
            ->get('borrow_books.id as borrow_id');

        foreach ($returnInfo as $key => $info){
            $borrowId = $info->borrow_id;
            foreach ($returned as $returnedItem) {
                if ($borrowId === $returnedItem->borrow_id) {
                    unset($returnInfo[$key]);
                    break;
                }
            }
        }

        return view("returnbooks.create", compact('user', 'returnInfo'));
    }

    public function approve()
    {
        $returnInfo = DB::table('borrow_books')
            ->join('books', 'borrow_books.book_id', '=', 'books.id')
            ->join('users', 'borrow_books.user_id', '=', 'users.id')
            ->join('return_books', 'borrow_books.id', '=', 'return_books.borrow_id')
            ->select(
                'users.name as user_name',
                'users.email as user_email',
                'return_books.created_at',
                'return_books.approve_status',
                'return_books.id',
                'return_books.date_return',
                'books.name as book_name',
                'borrow_books.borrow_date as borrow_date',
                'borrow_books.due_date as due_date',
            )->get();

        return view("returnbooks.approve", compact('returnInfo'));
    }

    public function store(Request $request)
    {
        $message = [
            'book_id.required' => 'Hãy chọn một cuốn sách'
        ];

        $validated = $request->validate([
            'book_id' => 'required',
        ], $message);

        $Returnbook = new ReturnBook;
        $Returnbook->borrow_id = $request->input('borrow_id');
        $Returnbook->message_user = $request->input('message_user');

        try {
            $Returnbook->save();
            return redirect()->route('history.history')->with('success', 'Lưu thành công');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Lỗi trong quá trình lưu dữ liệu');
        }
    }


    public function approveStore(Request $request)
    {
        $this->checkRequestAjax($request);

        try {
            $returnBook = ReturnBook::find($request->input('id'));

            $returnBook->date_return = $request->input('date_return');
            $returnBook->message_mod = $request->input('message_mod');
            $returnBook->approved_by = Auth::id();

            if ($request->input('btn') == 1 ){
                $returnBook->approve_status = 1;
            }elseif ($request->input('btn') == 2 ){
                $returnBook->approve_status = 2;
            }
            $returnBook->save();

            return BaseHelper::ajaxResponse(config('app.messageSaveSuccess'), true);
        } catch (Exception $e) {
            return BaseHelper::ajaxResponse(config('app.messageSaveError'), false);
        }
    }

    public function getRequestReturnBookAjax($id)
    {
        try {
            $requestReturnBook = DB::table('return_books as r')
                ->join('borrow_books as br', 'r.borrow_id', '=', 'br.id')
                ->join('users as u', 'u.id', '=', 'br.user_id')
                ->join('books as b', 'b.id', '=', 'br.book_id')
                ->where('r.id', '=', $id)
                ->get(['r.id', 'u.name', 'u.gender', 'u.birthday', 'u.email',
                    'r.approve_status', 'r.message_user',
                    'b.name as bookname', 'b.author', 'br.location',
                    'br.borrow_date', 'br.due_date', 'r.date_return', 'r.message_mod']);

            return BaseHelper::ajaxResponse(config('app.messageSaveSuccess'), true, $requestReturnBook[0]);
        } catch (Exception $e) {
            return BaseHelper::ajaxResponse(config('app.messageSaveError'), false);
        }
    }
}
