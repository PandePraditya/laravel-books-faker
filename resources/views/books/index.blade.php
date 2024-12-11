@extends('layout')

@section('title', 'Books')

@section('content')
    <div class="d-flex align-items-center">
        <p class="me-2">List Shown : </p>
        <!-- Rows per Page Dropdown -->
        <form method="GET" action="{{ route('books.index') }}">
            <input type="hidden" name="search" value="{{ $search }}">
            <select name="listShown" onchange="this.form.submit()" class="form-select">
                @for ($i = 10; $i <= 100; $i += 10)
                    <option value="{{ $i }}" {{ request('listShown') == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </form>
    </div>

    <div class="d-flex align-items-center">
        <p class="me-2">Search : </p>
        <form method="GET" action="{{ route('books.index') }}" class="py-2 d-flex">
            <input type="text" class="form-control mb-2 me-3" name="search" value="{{ $search }}" placeholder="Search by title, author, or category">
            <button type="submit" class="btn btn-primary h-50">Search</button>
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

    <!-- Pagination Links -->
    {{ $books->appends(request()->input())->links() }}
@endsection