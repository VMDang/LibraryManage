<?php

namespace App\Http\Controllers;

use BaseHelper;
use App\Models\Shelf;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class ShelfController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    static function getAllBookByShelfID(Shelf $shelf)
    {
        $books = Book::join('shelfs_books', 'books.id', '=', 'shelfs_books.book_id')
            ->where('shelfs_books.shelf_id', $shelf->id)
            ->get();

        return $books;
    }

    public function showList()
    {
        $allShelfs = Shelf::all();
        $booksByShelf = [];
        $statusOption = ['Đầy', 'Còn trống'];
        $floors = ['Tầng 01', 'Tầng 02', 'Tầng 03', 'Tầng 04', 'Tầng 05', 'Tầng 06'];
        $rooms = [];
        foreach ($floors as $floor) {
            $floorRooms = [];
            for ($i = 1; $i <= 10; $i++) {
                $roomNumber = 'Phòng ' . $i;
                $shelves = [];
                for ($j = 1; $j <= 10; $j++) {
                    $shelfNumber = 'Kệ ' . $j;
                    $shelves[] = $shelfNumber;
                }
                $floorRooms[$roomNumber] = $shelves;
            }
            $rooms[$floor] = $floorRooms;
        }
        // Lặp qua từng category và lấy danh sách các book
        foreach ($allShelfs as $shelf) {
            $books = self::getAllBookByShelfID($shelf);
            $booksByShelf[$shelf->id] = $books;
        }

        return view("shelfs.list", compact('allShelfs', 'booksByShelf','statusOption','rooms'));
    }
    public function addShelf()
    {   
        $statusOption = ['đầy', 'còn trống'];
        $floors = ['Tầng 01', 'Tầng 02', 'Tầng 03', 'Tầng 04', 'Tầng 05', 'Tầng 06'];

        $rooms = [];
        foreach ($floors as $floor) {
            $floorRooms = [];
            for ($i = 1; $i <= 10; $i++) {
                $roomNumber = 'Phòng ' . $i;
                $shelves = [];
                for ($j = 1; $j <= 10; $j++) {
                    $shelfNumber = 'Kệ ' . $j;
                    $shelves[] = $shelfNumber;
                }
                $floorRooms[$roomNumber] = $shelves;
            }
            $rooms[$floor] = $floorRooms;
        }
        return view("shelfs.add", compact('rooms','statusOption'));
    }
    public function store(Request $request)
    {   
        $shelf = new Shelf;
        $shelf->status = $request->status === 'đầy' ? 0 : 1 ;
        $shelf->location = $request->floor.' - '.$request->room.' - '.$request->shelf;
        $shelf->created_by = Auth::id();
        $shelf->updated_by= Auth::id();
        try{
            $shelf->save();
            return redirect()->route('shelf.list');
        }catch(\Exception $e){
            print($e);
            BaseHelper::ajaxResponse(config('app.messageSaveError'), false);
        }
    }
    public function search(){
        
    }
    public function update(Request $request){
        $shelfId = $request->input('shelfID');
        $status = $request->status === 'đầy' ? 0 : 1 ;
        $location = $request->floor.' - '.$request->room.' - '.$request->shelf;
        $currentDateTime = date_create();
        $currentDateTimeString = date_format($currentDateTime, 'Y-m-d H:i:s');
        $updateTimestamp = strtotime($currentDateTimeString); 
        $shelf = Shelf::find($shelfId);
        if($shelf){
            $shelf->id = $shelfId;
            $shelf->status = $status;
            $shelf->location= $location;
            $shelf->updated_by = Auth::id();
            $shelf->updated_at = $updateTimestamp;
            try{
                $shelf->save();
                return redirect()->route('shelf.list');
            }catch(\Exception $e){
                print($e);
                BaseHelper::ajaxResponse(config('app.messageSaveError'), false);
            }
        }else{
            // Xử lý khi không tìm thấy đối tượng shelf
            $errorMessage = "Không tìm thấy đối tượng shelf.";

            // Lưu thông báo thất bại vào session
            Session::flash('error', $errorMessage); 
            return redirect()->route('shelf.list');
        
        }

    }
    public function delete(Request $request){
        $this->checkRequestAjax($request);
        $ShelfId = $request->id;
        $shelf = Shelf::find($ShelfId);
        // Kiểm tra xem đối tượng tồn tại trong cơ sở dữ liệu hay không
        if (!$shelf) {
            return response()->json(['message' => 'Không tìm thấy đối tượng'], 404);
        }
        // Xóa đối tượng từ cơ sở dữ liệu
        $shelf->delete();
        return BaseHelper::ajaxResponse('Xóa shelf thành công' ,true);
    }
}
