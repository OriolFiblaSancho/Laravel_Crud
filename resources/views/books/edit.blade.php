@extends('layouts.app')

@section('content')
<!-- ??? section content -->
<h2>Edit Book</h2>
<form action="{{ route('books.update', $book) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Title</label>
        <input type="text" name="title" value="{{ $book->title }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Author</label>
        <textarea name="author" class="form-control" required>{{ $book->author }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection