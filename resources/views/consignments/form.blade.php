@extends('layouts.master')
@section('content')
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <h2 class="text-center">Add Consignment</h2>
        <form action="{{ url('/consignment/add/'.$batch_id) }}" method="post">
            <div class="form-group">
            <label for="drv_name">Item Name:</label>
            <input type="text" class="form-control" id="drv_name" placeholder="Enter name" name="item_name" value="{{ old('item_name') }}">
            </div>
            <div class="form-group">
            <label for="drv_email">Address:</label>
            <input type="text" class="form-control" id="drv_email" placeholder="Enter email" name="address" value="{{ old('address') }}">
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
