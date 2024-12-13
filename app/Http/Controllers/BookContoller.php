<?php

namespace App\Http\Controllers;

use App\Models\book;
use Illuminate\Database\Eloquent\Builder; // Builder class from Eloquent
use Illuminate\Http\Request;

class BookContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search'); // Get the search query
        $listShown = $request->input('listShown', 10); // Get the number of items per page, default is 10

        // Filter by title, author, or category
        $books = Book::with(['author', 'category', 'ratings'])
            // If search query is present, filter by title, author, or category
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                    ->orWhereHas('author', function (Builder $q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('category', function (Builder $q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            ->withAvg('ratings', 'rating') // load average rating
            ->orderByDesc('ratings_avg_rating') // Default sort by highest rating
            ->paginate($listShown); // Paginate the results by listShown

        return view('books.index', compact('books', 'search'));
    }
}
