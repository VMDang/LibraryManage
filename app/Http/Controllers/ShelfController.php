<?php

namespace App\Http\Controllers;

use BaseHelper;
use App\Models\Shelf;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Shelf_Book;
use Illuminate\Support\Facades\Auth;

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
        // Lấy tất cả đối tượng Books_Category có category_id tương ứng với ID của Category
        $Books_Shelf = Shelf_Book::where('shelf_id', $shelf->id)->get();

        $bookIds = $Books_Shelf->pluck('book_id')->toArray();

        // Lấy danh sách các đối tượng book dựa vào book_id
        $books = Book::whereIn('id', $bookIds)->get();

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
        $shelf->id = $request->name;
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
    public function update(){
        
    }
    public function delete(){
        
    }
}
