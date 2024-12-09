@extends('layout')

@section('title', 'Input Rating')

@section('content')
<div class="container">
    <h1>Input Rating</h1>
    <form action="{{ route('ratings.store') }}" method="POST">
        @csrf
        <div class="w-50 py-3">
            <div class="form-group">
                <label for="author_id">Select Author</label>
                <select id="author_id" name="author_id" class="form-control">
                    <option value="">-- Select Author --</option>
                    @foreach ($authors as $author)
                        <option value="{{ $author->id }}">{{ $author->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="book_id">Select Book</label>
                <select id="book_id" name="book_id" class="form-control" required>
                    <option value="">-- Select Book --</option>
                    @foreach ($books as $book)
                        <option value="{{ $book->id }}" data-author-id="{{ $book->author_id }}" style="display: none;">
                            {{ $book->title }} ({{ $book->author->name }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
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
</div>

<script>
document.getElementById('author_id').addEventListener('change', function() {
    const authorId = this.value;
    const bookSelect = document.getElementById('book_id');
    
    // Reset book select
    Array.from(bookSelect.options).forEach(option => {
        if (option.value) {
            option.style.display = authorId === '' || option.dataset.authorId === authorId ? 'block' : 'none';
        }
    });
    
    // Reset book selection
    bookSelect.selectedIndex = 0;
});
</script>
@endsection