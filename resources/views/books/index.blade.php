@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Book List</h2>
    <a class="btn btn-primary" href="{{ route('books.create') }}">Create Book</a>
</div>
@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Author</th>
        <th>Action</th>
    </tr>
    @foreach ($books as $book)
    <tr>
        <td>{{ $book->id }}</td>
        <td>{{ $book->title }}</td>
        <td>{{ $book->author }}</td>
        <td>
            <a class="btn btn-info btn-sm" href="{{ route('books.show', $book) }}">Show</a>
            <a class="btn btn-warning btn-sm" href="{{ route('books.edit', $book) }}">Edit</a>
            <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline">
                @csrf @method('DELETE')
                <!-- ??? que es csrf -->
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
{{ $books->links() }}
@endsection