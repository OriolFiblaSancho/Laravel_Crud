@extends('layouts.app')

@section('content')
<!-- ??? section content -->
<h2>Edit Student</h2>
<form action="{{ route('students.update', $student) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" value="{{ $student->name }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Email</label>
        <textarea name="email" class="form-control" required>{{ $student->email }}</textarea>
    </div>
    <div class="mb-3">
        <label>Course</label>
        <select name="course_id" class="form-control" required>
            <option value="">Select Course</option>
            @foreach($courses as $course)
                <option value="{{ $course->id }}">{{ $course->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection