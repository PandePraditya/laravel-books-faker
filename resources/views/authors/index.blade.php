@extends('layout')

@section('title', 'Top 10 Authors')

@section('content')
    <h1>Top 10 Most Famous Authors </h1>

    <!-- Authors Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Author Name</th>
                <th>Voter Count</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($authors as $author)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $author->name }}</td>
                    <td>{{ $author->voters_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection