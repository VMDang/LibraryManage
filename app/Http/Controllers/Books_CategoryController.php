<?php

namespace App\Http\Controllers;
use App\Models\Books_Category;
use Illuminate\Http\Request;
use App\Models\Category;

class Books_CategoryController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    function getAllBookByCategoryID(Category $category)
    {
        // Lấy tất cả đối tượng Category_Book có category_id tương ứng với ID của Category
        $categoryBooks = Books_Category::where('category_id', $category->id)->get();

        // Lấy các trường ID, category_id, book_id từ các đối tượng Category_Book
        $categoryBooksData = $categoryBooks->map(function ($categoryBook) {
            return [
                'ID' => $categoryBook->id,
                'category_id' => $categoryBook->category_id,
                'book_id' => $categoryBook->book_id,
            ];
        });

        return $categoryBooksData;
    }
}
