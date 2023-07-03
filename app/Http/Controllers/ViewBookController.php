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
        $categories = Category::all();
        return view('view_book.create', compact('categories'));
    }
}