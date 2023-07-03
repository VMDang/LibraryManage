<?php

namespace App\Http\Controllers;

use BaseHelper;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Borrowing;
use App\Models\Book;
use App\Models\ReturnBook;
use App\Models\Category; 
use App\Models\Shelf_Book; 
use App\Models\Books_Category; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ViewBookController extends Controller
{
    /**
     * Show the form for creating a new request borrow book.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $book_categories = Books_Category::with('book','category')->get();
        $books = Book::all();
        $categories = Category::all();
        return view('view_book.create', compact('book_categories','books','categories'));
    }
    public function detail($id = null) {
        $book = Book::find($id);
        $book_categories = Books_Category::with('book','category')->get();
        $shelf_books = Shelf_Book::with('book','shelf')->get(); 
        if (empty($id)){
            return ;
        }

        // User cannot see the account being locked
       

        return view('view_book.detail', compact('book','book_categories','shelf_books'));
    }
    
}