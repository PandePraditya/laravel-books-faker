<?php

namespace App\Http\Controllers;

use App\Models\author;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() 
    {
        $authors = Author::select('authors.*')
            ->join('books', 'authors.id', '=', 'books.author_id')
            ->join('ratings', 'books.id', '=', 'ratings.book_id') 
            ->selectRaw('authors.*, COUNT(ratings.voter) as voter_count') // Count the number of voters
            ->groupBy('authors.id') // Group by author to count voters correctly
            ->having('voter_count', '>=', 5) // Only include authors with more than 5 voters
            ->orderBy('voter_count', 'desc') // Order by the voter count
            ->limit(10) // Limit top 10
            ->get();

        return view('authors.index', compact('authors'));
    }
}
