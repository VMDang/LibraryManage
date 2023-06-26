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
                  'borrowings.borrow_date',
                  'borrowings.id as borrow_id',
              )
              ->get();
              
            
          $books = $returnInfo->pluck('book_name', 'book_id');
        return view("returnbooks.create", compact('user', 'books', 'returnInfo'));
      }

    public function approve()
      {
        $user = Auth::user();
        $returnInfo = DB::table('borrowings')
              ->join('books', 'borrowings.book_id', '=', 'books.id')
              ->join('users', 'borrowings.user_id', '=', 'users.id')
              ->leftJoin('return_books', 'borrowings.id', '=', 'return_books.borrow_id')
              ->where('users.id', '=', Auth::id())
              ->select(
                  'users.name as user_name',
                  'users.birthday as birthday', 
                  'users.email as user_email',
                  'return_books.borrow_id',
                  'return_books.message_user',
                  'return_books.message_mod',
                  'return_books.created_at',
                  'return_books.approve_status as approve_status',
                  'return_books.id',
                  'books.name as book_name',
                  'books.author',
                  'books.category_id',
                  'books.id as book_id',
                  'borrowings.message_user AS borrowing_message_user',
                  'borrowings.message_approver',
                  'borrowings.borrow_date',
                  'borrowings.id as borrow_id',
                  
              )
              ->get();
              $books = $returnInfo->pluck('book_name', 'book_id');
              return view("returnbooks.approve", compact('user', 'books', 'returnInfo'));
            }
    
    public function store(Request $request)
    {
      $message = [
        'book-name.required' => 'Hãy chọn một cuốn sách',
    ];

    $validated = $request->validate([
        'book-name' => 'required',
    ], $message);

    if (!$request->has('book-name')) {
        return redirect()->back()->withInput()->withErrors(['book-name' => 'Hãy chọn một cuốn sách']);
    }
        $Returnbook = new ReturnBook;
        $Returnbook->borrow_id = $request->input('borrow_id');
        $Returnbook->message_user = $request->input('message_user');
       
        try {
            $Returnbook->save();
            return redirect()->route('return.create')->with('success', 'Lưu thành công')->withInput($validated);
          } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi trong quá trình lưu dữ liệu');
        }
    }
    
    public function approve_btn(Request $request)
{
    

    try {
        DB::transaction(function () use ($request) {
            $returnBook = ReturnBook::findOrFail($request->input('id'));
            $returnBook->date_return = $request->input('date_return');
            $returnBook->message_mod = $request->input('message_mod');
            $returnBook->approve_status = 1; // Cập nhật trạng thái phê duyệt

            // if ($request->has('approve_btn')) {
            //     $returnBook->approve_status = 1; // Cập nhật trạng thái phê duyệt
            // } elseif ($request->has('decline_btn')) {
            //     $returnBook->approve_status = 2; // Cập nhật trạng thái từ chối
            // }

            $returnBook->save();
              
            // Thực hiện các xử lý khác nếu cần
        });
    //    dd($request);
       
        return redirect()->route('return.approve')->with('success', 'Lưu thành công');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Lỗi trong quá trình lưu dữ liệu');
    }
}



}