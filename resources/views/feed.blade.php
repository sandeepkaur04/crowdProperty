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
            <h2 class="text-center">User Feed</h2>
            <form method="post" action="{{ url('/user/upd-url') }}">
                <div class="input-group">
                    <input type="url" class="form-control" name="rss_url" value="{{ $feed_url }}">
                    <span class="input-group-btn">
                        @csrf
                        <button class="btn btn-default" type="submit">Search!</button>
                    </span>
                </div>
            </form>
            @if(@$feed && @$feed['channel'])
                @if(@$feed['channel']->item)
                <?php
                    $count = 1;
                    $ind = 0;
                ?>
                    @foreach(@$feed['channel']->item as $key => $value)
                        <?php 
                            $other_info = (array) @$value->enclosure;
                            $attr_len =  @$other_info['@attributes']['length'];
                            // echo '<pre>'; print_r($attr_len); die;
                        ?>
                        <div class="row col-md-12 des">
                          {{ $count }}) {{ $value->title }}
                            <div>
                                Story Count: {{ number_format($attr_len) }} 
                                <span class="al_det"><a href="{{ url('user/feed/'.$ind) }}">View Detail</a> </span>
                            </div>
                        </div>
                        <?php
                            $count += 1;
                            $ind += 1;
                        ?>
                    @endforeach
                @endif
            @endif
        </div>
    </div>
    <div class="col-md-3"></div>
</div>
@endsection
