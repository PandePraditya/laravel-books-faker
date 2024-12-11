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
    $authors = Author::withCount('ratings as voters_count') // Assumes you have a proper relationship setup
        ->having('voters_count', '>=', 5)
        ->orderByDesc('voters_count')
        ->limit(10)
        ->get();

    return view('authors.index', compact('authors'));
}
}
