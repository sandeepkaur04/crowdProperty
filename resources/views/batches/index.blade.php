@extends('layouts.master')
<style>
    .des {
        padding: 5px;
        border: 1px solid paleturquoise;
        margin-top: 10px;
    }
    .al_det {
        float: right
    }
</style>

@section('content')
<div class="row">
    <div class="col-md-3"></div>
        <div class="col-md-6">
            <h2 class="text-center">Batches</h2>
            <h6 class="text-center pull-left"><a href="{{ url('/batch/add') }}">Add batch</a></h6>
            @foreach($batches as $data => $value)
            <div class="row col-md-12 des">
                <div>
                    Driver: {{ $value['driver_name'] }} <br>
                    Email: {{ $value['email'] }} <br>
                    <span class="al_det"><a href="{{ url('consignments/'.$value['id']) }}">Consignments</a> </span>
                    @if($value['is_ended'] == '0')
                    <br>
                    <span class="al_det"><a href="{{ url('batch/end/'.$value['id']) }}">End Batch</a> </span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="col-md-3"></div>
</div>
@endsection
