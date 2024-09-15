<?php

namespace App\Http\Controllers;

use App\Models\book;
use Illuminate\Http\Request;

class BookContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search'); // Get the search query
        $listShown = $request->input('listShown', 10); // Get the number of items per page

        $books = book::with('author', 'category', 'ratings')
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")->orWhereHas('author', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    })->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })->paginate($listShown);

        return view('books.index', compact('books', 'search', 'listShown'));
    }
}
