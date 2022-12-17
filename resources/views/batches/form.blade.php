@extends('layouts.master')
@section('content')
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <h2 class="text-center">Add Batch</h2>
        <form action="{{ url('/batch/add') }}" method="post">
            <div class="form-group">
            <label for="drv_name">Driver Name:</label>
            <input type="text" class="form-control" id="drv_name" placeholder="Enter name" name="driver_name" value="{{ old('driver_name') }}">
            </div>
            <div class="form-group">
            <label for="drv_email">Driver Email:</label>
            <input type="email" class="form-control" id="drv_email" placeholder="Enter email" name="driver_email" value="{{ old('driver_email') }}">
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
        </form>
    </div>
    <div class="col-md-3"></div>
@endsection
