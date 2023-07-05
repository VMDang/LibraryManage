<?php

namespace App\Http\Controllers;

use BaseHelper;
use App\Models\Book;
use App\Models\Books_Category;
use App\Models\Category;
use App\Models\Shelf;
use App\Models\Shelf_Book;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index()
    {
        $books = Book::all();
        $categories = Category::all();
        $book_categories = Books_Category::with('book','category')->get();
        $books_shelf = Shelf_Book::with('book', 'shelf')->get();

        return view('books.list', compact('book_categories','books', 'categories', 'books_shelf'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
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
     * @param Request $request
     * @return Response
     */

    public function store(Request $request)
    {
        $message = [
            'name.required' => 'Tên sách bắt buộc nhập',
            'author.required' => 'Tên tác giả bắt buộc nhập',
            'number.required' => 'Số lượng sách bắt buộc nhập ',
            'number.integer' => 'Số lượng sách phải là số nguyên lớn hơn hoặc bằng 0',
            'cost.required' => 'Số lượng sách bắt buộc nhập ',
            'cost.integer' => 'Số lượng sách bắt buộc nhập ',
            'shelfs.required' => 'Bắt buộc chọn vị trí',
            'categories.required' => 'Bắt buộc chọn thể loại',
        ];
        $validated = $request->validate([
            'name' => 'required',
            'author' => 'required',
            'number' => 'required|integer',
            'cost' => 'required|integer',
            'shelfs' => 'required',
            'categories' => 'required',
        ], $message);

        $book = new Book;
        $book->name = $request->name;
        $book->author = $request->author;
        $book->publisher = $request->publisher;
        $book->date_publication = $request->date_publication;
        $book->preview_content = $request->preview_content;
        $book->number = $request->number;
        $book->cost = $request->cost;
        $book->created_by = Auth::id();
        $book->save();

        $bookId = $book->id;

        foreach ($request->input('shelfs') as $s){
            $shelfs_book = new Shelf_Book;
            $shelfs_book->book_id = $bookId;
            $shelfs_book->shelf_id = $s;
            $shelfs_book->created_by = Auth::id();
            $shelfs_book->updated_by = Auth::id();
            $shelfs_book->save();
        }

        foreach ($request->input('categories') as $c){
            $category_book = new Books_Category;
            $category_book->book_id = $bookId;
            $category_book->category_id = $c;
            $category_book->created_by = Auth::id();
            $category_book->updated_by = Auth::id();
            $category_book->save();
        }

        return redirect()->route('books.list');
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */

    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $book = Book::find($id);
        $categories = Category::all();
        $shelfs = Shelf::all();
        $book_categories = Books_Category::with('book', 'category')->get();
        $shelf_books = Shelf_Book::with('book', 'shelf')->get();
        if (empty($id)) {
            return abort(404, 'Cuốn sách không tồn tại');
        }

        return view('books.edit', compact('book', 'book_categories', 'shelf_books', 'categories', 'shelfs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $message = [
            'name.required' => 'Tên sách bắt buộc nhập',
            'author.required' => 'Tên tác giả bắt buộc nhập',
            'number.required' => 'Số lượng sách bắt buộc nhập ',
            'number.integer' => 'Số lượng sách phải là số nguyên lớn hơn hoặc bằng 0',
            'cost.required' => 'Số lượng sách bắt buộc nhập ',
            'cost.integer' => 'Số lượng sách bắt buộc nhập ',
            'shelfs.required' => 'Bắt buộc chọn vị trí',
            'categories.required' => 'Bắt buộc chọn thể loại',
        ];
        $validated = $request->validate([
            'name' => 'required',
            'author' => 'required',
            'number' => 'required|integer',
            'cost' => 'required|integer',
            'shelfs' => 'required',
            'categories' => 'required',
        ], $message);

        $book = Book::find($id);
        if (!$book) {
            abort('404', 'Cuốn sách không tồn tại');
        }

        $book->name = $request->name;
        $book->author = $request->author;
        $book->publisher = $request->publisher;
        $book->date_publication = $request->date_publication;
        $book->preview_content = $request->preview_content;

        $book->save();

        $shelfs = $request->input('shelfs', []);
        $book->shelfs()->sync($shelfs);

        $categories = $request->input('categories', []);
        $book->categories()->sync($categories);

        return redirect()->route('books.list')->with('success', 'Book updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return redirect()->route('books.index')->with('error', 'Book not found');
        }

        $book->shelfs()->detach();

        $book->categories()->detach();

        $book->delete();

        return redirect()->route('books.list')->with('success', 'Book deleted successfully');
    }

    public function detail($id = null) {
        $book = Book::find($id);
        $book_categories = Books_Category::with('book','category')->get();
        $shelf_books = Shelf_Book::with('book','shelf')->get();
        if (empty($id)){
            return ;
        }

        return view('books.detail', compact('book','book_categories','shelf_books'));
    }

    public function getInfoAjax($id){
        try {
            $book = Book::find($id);
            if ($book == null){
                return \BaseHelper::ajaxResponse("Thông tin cuốn sách không tồn tại", false);
            }

            return BaseHelper::ajaxResponse(config('app.messageSaveSuccess'),true, $book);
        }
        catch (\Exception $e){
            return BaseHelper::ajaxResponse(config('app.messageSaveError'), false);
        }
    }
}
