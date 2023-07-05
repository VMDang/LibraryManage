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
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;

class ViewBookController extends Controller
{
    /**
     * Show the form for creating a new request borrow book.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        $books = Book::all();
        $categories = Category::all();

        //  $test =  DB::table('books as b')
        // ->join('books_categories as bc', 'b.id', '=', 'bc.book_id')
        // ->join('categories as c', 'c.id', '=', 'bc.category_id')
        // ->get(["b.name as book_name"]);
    
        // $arr=[];

        // foreach ($test as $key => $t) {
        //     $tmp = DB::table('books as b')
        // ->join('books_categories as bc', 'b.id', '=', 'bc.book_id')
        // ->join('categories as c', 'c.id', '=', 'bc.category_id')
        // ->where('b.name', '=', $t->book_name)
        // ->get(["c.name as cate_name"]);
        //     $arr[$t->book_name] = $tmp;
        // }


        // dd($arr);

        // $filters = $request->all();
        // if($request->isMethod('post')){
            
        //     $query  = Books_Category::with('book','category');

        //     foreach ($filters as $key => $value) {
        //         if ($value != '' && $value != NULL) {
        //             switch ($key) {
        //                 case 'name':
        //                     $query->where('name', 'LIKE', '%' . $value . '%');
        //                     break;
        //                 case 'cost':
        //                     $query->where('cost', 'LIKE', '%' . $value . '%');
        //                     break;
        //                 case 'author':
        //                     $query->where('author', 'LIKE', '%' . $value . '%');
        //                     break;
        //                 case 'category':
        //                     $query->where('id', '=', $value);
        //                     break;
                    
        //                 default:
        //                     break;
        //             }
        //         }
        //     }
        //     $book_categories = $query -> get() ;
        //     dd($book_categories,Books_Category::with('book','category')->get());
        //     return view('view_book.create', compact('book_categories','books','categories'));
        // }
        $book_categories = Books_Category::with('book','category')->get();
        
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
