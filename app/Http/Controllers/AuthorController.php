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
    $authors = Author::withCount('ratings as voters_count') // Get the number of ratings for each author
        ->having('voters_count', '>=', 5) // Filter authors with at least 5 ratings and more
        ->orderByDesc('voters_count') // Sort by the number of ratings
        ->limit(10) // Limit to the top 10
        ->get();

    return view('authors.index', compact('authors')); // Pass authors to the view
}
}
