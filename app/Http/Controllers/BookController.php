<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookOrderChannel;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function show(Book $book)
    {
        $orderChannels = BookOrderChannel::active()->ordered()->get();

        return view('books.show', compact('book', 'orderChannels'));
    }
}
