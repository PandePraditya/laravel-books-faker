@extends('layout')

@section('title', 'Books')

@section('content')
    
    <div class="d-flex">
        <p class="me-2">List Shown : </p>
        <!-- Rows per Page Dropdown -->
        <form method="GET" action="{{ route('books.index') }}">
            <input type="hidden" name="search" value="{{ $search }}">
            <select name="listShown" onchange="this.form.submit()" class="form-select">
                <option value="10" {{ $listShown == 10 ? 'selected' : '' }}>10 rows</option>
                <option value="100" {{ $listShown == 100 ? 'selected' : '' }}>100 rows</option>
            </select>
        </form>
    </div>

    <div class="d-flex">
        <p class="me-2">Search : </p>
        <form method="GET" action="{{ route('books.index') }}" class="py-2">
            <input type="text" class="form-control mb-2" name="search" value="{{ $search }}" placeholder="Search by title, author, or category">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>

    <table border="2" class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Book Name</th>
                <th>Category Name</th>
                <th>Author Name</th>
                <th>Average Rating</th>
                <th>Voters</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr>
                    <th scope="row">
                        {{ ($books->currentPage() - 1) * $books->perPage() + $loop->iteration }}
                    </th>

                    <!-- Book Name -->
                    <td>{{ $book->title }}</td>

                    <!-- Category Name -->
                    <td>{{ $book->category->name ?? 'N/A' }}</td>

                    <!-- Author Name -->
                    <td>{{ $book->author->name ?? 'N/A' }}</td>

                    <!-- Average Rating -->
                    <td>
                        @php
                            $averageRating = $book->ratings->isNotEmpty() ? $book->ratings->avg('rating') : 0;
                        @endphp
                        {{ number_format($averageRating, 2) }}
                    </td>

                    <!-- Voter Count -->
                    <td>{{ $book->ratings->count() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection