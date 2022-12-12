@extends('layouts.master')
@section('content')
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <h2 class="text-center">Registration</h2>
        <form action="{{ url('/register') }}" method="post">
            <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" class="form-control" id="email" placeholder="Enter email" name="email" value="{{ old('email') }}">
            </div>
            <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd" value="{{ old('pwd') }}">
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @csrf
            <button type="submit" class="btn btn-default">Submit</button>
            <br>
            <span>
                Already  have an account? <a href="{{ url('/login') }}"> Login </a>
            </span>
        </form>
    </div>
    <div class="col-md-3"></div>
@endsection
