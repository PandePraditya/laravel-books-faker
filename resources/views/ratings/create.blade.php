@extends('layout')

@section('title', 'Input Rating')

@section('content')
    <div class="container">
        <h1>Input Rating</h1>
        <form action="{{ route('ratings.create') }}" method="GET">
            @csrf
            <div class="w-50 my-2">
                {{-- Author --}}
                <div class="form-group">
                    <label for="author_id">Select Author</label>
                    <select id="author_id" name="author_id" class="form-control" onchange="this.form.submit()">
                        <option value="">-- Select Author --</option>
                        @foreach ($authors as $author)
                            <option value="{{ $author->id }}" {{ request('author_id') == $author->id ? 'selected' : '' }}>
                                {{ $author->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>

        @if (request('author_id'))
            <form action="{{ route('ratings.store') }}" method="POST">
                @csrf
                <div class="w-50">
                    {{-- Book --}}
                    <div class="form-group">
                        <label for="book_id">Select Book</label>
                        <select id="book_id" name="book_id" class="form-control" required>
                            <option value="">-- Select Book --</option>
                            @foreach ($books as $book)
                                @if ($book->author_id == request('author_id'))
                                    <option value="{{ $book->id }}">{{ $book->title }} ({{ $book->author->name }})
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    {{-- Rating --}}
                    <div class="form-group my-2">
                        <label for="rating">Rating</label>
                        <select id="rating" name="rating" class="form-control" required>
                            @for ($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Submit Rating</button>
            </form>
        @endif
    </div>
@endsection
