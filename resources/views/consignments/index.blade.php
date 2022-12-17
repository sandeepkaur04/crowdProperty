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
            <h2 class="text-center">Consignments</h2>
            @if($can_add == '0')
            <h6 class="text-center pull-left"><a href="{{ url('/consignment/add/'.$batch_id) }}">Add Consignments</a></h6>
            @endif
            @foreach($consignments as $data => $value)
            <div class="row col-md-12 des">
                <div>
                    Item name: {{ $value['name'] }} <br>
                    Address: {{ $value['address'] }} <br>
                    Unique Number: {{ $value['cons_no'] }} <br>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="col-md-3"></div>
</div>
@endsection
