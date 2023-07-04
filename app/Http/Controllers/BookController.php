<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\Category;
use App\Models\Shelf;
use App\Models\Shelf_Book;
use App\Models\Books_Category;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function category()
    // {
    //     return $this->belongsTo(Category::class);
    // }
    
    // public function shelf()
    // {
    //     return $this->belongsTo(Shelf::class);
    // }


    public function index()
    {
         $books = Book::all();
         return view ('books.list')->with('books', $books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $categories = Category::all();
        $shelfs = Shelf::all();
        return view("books.create", compact('categories', 'shelfs'));
             
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
{
    $book = new Book;
    $book->name = $request->name;
    $book->author = $request->author;
    $book->publisher = $request->publisher;
    $book->date_publication = $request->date_publication;
    $book->preview_content = $request->preview_content;
    $book->save();

    $bookId = $book->id;

    $shelfs_book = new Shelf_Book;
    $shelfs_book->book_id = $bookId;
    $shelfs_book->shelf_id = $request->shelf;
    $shelfs_book->created_by = Auth::id();
    $shelfs_book->updated_by = Auth::id();
    $shelfs_book->save();

    $category_book = new Books_Category;
    $category_book->book_id = $bookId;
    $category_book->category_id = $request->category;
    $category_book->created_by = Auth::id();
    $category_book->updated_by = Auth::id();
    $category_book->save();

    return redirect()->route('books.create');
}



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id);
        $book_categories = Books_Category::with('book','category')->get();
        $shelf_books = Shelf_Book::with('book','shelf')->get(); 
        if (empty($id)){
            return ;
        }

        // User cannot see the account being locked
       

        return view('books.edit', compact('book','book_categories','shelf_books'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = Book::find($id);
    if (!$book) {
        return redirect()->route('books.index')->with('error', 'Book not found');
    }
    
    $book->name = $request->name;
    $book->author = $request->author;
    $book->publisher = $request->publisher;
    $book->date_publication = $request->date_publication;
    $book->preview_content = $request->preview_content;

    // Lưu thông tin sách
    $book->save();

    // Cập nhật thông tin vị trí sách
    $shelfs = $request->input('shelfs', []);
    $book->shelfs()->sync($shelfs);

    // Cập nhật thông tin thể loại sách
    $categories = $request->input('categories', []);
    $book->categories()->sync($categories);

    return redirect()->route('books.index')->with('success', 'Book updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // // {
    // //     $book = Book::find($id);
    // // if ($book) {
    // //     $book->delete();
    // //     // Thực hiện các xử lý khác nếu cần
    // //     return redirect()->route('books.index')->with('success', 'Book deleted successfully');
    // // } else {
    // //     return redirect()->route('books.index')->with('error', 'Book not found');
    // // }
    // // }
    public function destroy($id)
{
    $book = Book::find($id);

    if (!$book) {
        return redirect()->route('books.index')->with('error', 'Book not found');
    }

    // Xóa thông tin vị trí sách trong bảng shelfs_books
    $book->shelfs()->detach();

    // Xóa thông tin thể loại sách trong bảng books_categories
    $book->categories()->detach();

    // Xóa sách
    $book->delete();

    // Thực hiện các xử lý khác nếu cần
    return redirect()->route('books.index')->with('success', 'Book deleted successfully');
}
    
}
