<?php

namespace App\Http\Controllers;

use App\Models\author;
use App\Models\book;
use App\Models\rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch authors and books for the dropdown inputs
        $authors = author::orderBy('name', 'desc')->get();
        $books = book::with('author')->paginate(50);
        return view('ratings.create', compact('books', 'authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'rating' => 'required|integer|between:1,10',
        ]);

        // Create new rating
        rating::create([
            'book_id' => $request->input('book_id'),
            'rating' => $request->input('rating'),
        ]);

        // Redirect to the list of books
        return redirect()->route('books.index');
    }
}
