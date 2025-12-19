@extends('layouts.private')

@section('content')
<div class="text-center">
    <h1 class="mb-3">Login</h1>
    <p class="mb-3">Please enter your credentials to log in.</p>
    <form method="POST" action="{{ url('api/login') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
</div>
@endsection