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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class HistoryController extends Controller
{
    /**
     * Show the table history borrow and return books.
     *
     * @return \Illuminate\Http\Response
     */
    public function history(){
        $user = Auth::user();
        $borrowings = Borrowing::with('user', 'book')->get();
        $returns = ReturnBook::with('borrow_id')->get();
        return view('history.history', compact('user', 'borrowings','returns'));
    }
}
