<?php

namespace App\Http\Controllers;

use BaseHelper;
use App\Models\Category;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class CategoryController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    static function getAllBookByCategoryID(Category $category)
    {
        $books = Book::join('books_categories', 'books.id', '=', 'books_categories.book_id')
            ->where('books_categories.category_id', $category->id)
            ->get();

        return $books;
    }

    public function showList()
    {
        $allCategories = Category::all();
        $booksByCategory = [];

        // Lặp qua từng category và lấy danh sách các book
        foreach ($allCategories as $category) {
            $books = self::getAllBookByCategoryID($category);
            $booksByCategory[$category->id] = $books;
        }

        return view("categories.list", compact('allCategories', 'booksByCategory'));
    }
    public function addCategory()
    {   
        return view("categories.add");
    }
    public function store(Request $request)
    {   
        // 'id', 'name', 'description', 'status',
        // 'created_by', 'updated_by', 'created_at', 'updated_at',
        $category = new Category;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->status = $request->status;
        $category->created_by = Auth::id();
        $category->updated_by= Auth::id();
        try{
            $category->save();
            return redirect()->route('category.list');
        }catch(\Exception $e){
            print($e);
            BaseHelper::ajaxResponse(config('app.messageSaveError'), false);
        }
    }
    public function update(Request $request){
        $categoryId = $request->input('category_id');
        $name = $request->input('name');
        $status = $request->input('status');
        $description = $request->input('description');
        $currentDateTime = date_create();
        $currentDateTimeString = date_format($currentDateTime, 'Y-m-d H:i:s');
        $updateTimestamp = strtotime($currentDateTimeString); 
        // Lấy đối tượng category từ cơ sở dữ liệu bằng ID
        $category = Category::find($categoryId);

        if($category){
            // Cập nhật các thuộc tính của đối tượng category
            $category->name = $name;
            $category->status = $status;
            $category->description = $description;
            $category->created_at = $category->created_at;
            $category->updated_by = Auth::id();
            $category->updated_at = $updateTimestamp;
            // Lưu các thay đổi vào cơ sở dữ liệu
            try{
                $category->save();
                return redirect()->route('category.list');
            }catch(\Exception $e){
                print($e);
                BaseHelper::ajaxResponse(config('app.messageSaveError'), false);
            }
            // Thực hiện các xử lý hoặc chuyển hướng sau khi cập nhật thành công
            // ...
        } else {
            // Xử lý khi không tìm thấy đối tượng category
            $errorMessage = "Không tìm thấy đối tượng category.";

            // Lưu thông báo thất bại vào session
            Session::flash('error', $errorMessage); 
            return redirect()->route('category.list');
            }

        // Chuyển hướng hoặc trả về response tùy theo logic của ứng dụng
        // ...
    }
    public function search(){
        
    }
    public function delete(Request $request){
        $this->checkRequestAjax($request);
        $categoryId = $request->id;
        $category = Category::find($categoryId);
        // Kiểm tra xem đối tượng tồn tại trong cơ sở dữ liệu hay không
        if (!$category) {
            return response()->json(['message' => 'Không tìm thấy đối tượng'], 404);
        }
        // Xóa đối tượng từ cơ sở dữ liệu
        $category->delete();
        return BaseHelper::ajaxResponse('Xóa shelf thành công' ,true);

    }
}
