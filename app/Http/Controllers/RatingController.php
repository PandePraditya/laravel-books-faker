<?php

namespace App\Http\Controllers;

use App\Models\author;
use App\Models\book;
use App\Models\rating;
use Illuminate\Database\Eloquent\Builder; // Builder class from Eloquent
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Fetch authors for the dropdown
        $authors = author::orderBy('name', 'asc')->get();

        // Fetch books for the dropdown, optionally filtered by author
        // If author_id is present and not empty, filter by author
        $books = book::with('author')->where(function (Builder $query) use ($request) {
            if ($request->has('author_id') && $request->author_id) {
                $query->where('author_id', $request->author_id); // Filter by author
            }
        })->get();

        return view('ratings.create', compact('books', 'authors')); // Pass authors and books to the view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'book_id' => 'required|exists:books,id', // Check if the book exists
            'rating' => 'required|integer|between:1,10', // Rating only between 1 and 10
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
