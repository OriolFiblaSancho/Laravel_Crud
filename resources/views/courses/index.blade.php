@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Course List</h2>
    <a class="btn btn-primary" href="{{ route('courses.create') }}">Create Course</a>
    
</div>
@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Actions</th>
    </tr>
    @foreach ($courses as $course)
    <tr>
        <td>{{ $course->id }}</td>
        <td>{{ $course->name }}</td>
        <td>
            <a class="btn btn-info btn-sm" href="{{ route('courses.show', $course) }}">Show</a>
            <a class="btn btn-warning btn-sm" href="{{ route('courses.edit', $course) }}">Edit</a>
            <form action="{{ route('courses.destroy', $course) }}" method="POST" class="d-inline">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
{{ $courses->links() }}
@endsection