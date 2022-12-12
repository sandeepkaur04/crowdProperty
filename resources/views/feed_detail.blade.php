@extends('layouts.master')
@section('content')
<style>
    .al_det {
        float: right
    }
</style>

    <div class="col-md-3"><span class="al_det"><a href="{{ url('/user/feed') }}">Back</a> </span></div>
        <div class="col-md-6">
            <h2 class="text-center">Feed Details</h2>
            @if(@$feed && @$feed['channel'])
                @if(@$feed['channel']->item)
                <?php
                    $ind = 0;
                ?>
                    @foreach(@$feed['channel']->item as $key => $value)
                        @if($ind == $feed_ind)
                            <?php 
                                $other_info = (array) @$value->enclosure;
                                $attr_len =  @$other_info['@attributes']['length'];
                                $feed_url = @$other_info['@attributes']['url'];
                            ?>
                            <div class="row col-md-12">
                                <b>Title: </b>{{ $value->title }}
                                <div> <b>Story Count:</b> {{ number_format($attr_len) }} 
                                    
                                </div>

                                <div> <b>Published On: </b> {{ $value->pubDate }} </div>
                                <div> <b>Source: </b> {{ $value->source }} </div>

                                <div>
                                    <b>Description: </b> {{ $value->description }} 
                                    <span class="al_det"><a href="{{ $value->link }}" target="_blank">View Full Details</a> </span>
                                </div>
                            </div>
                            
                        @endif
                        <?php
                            $ind += 1;
                        ?>
                    @endforeach
                @endif
            @endif
        </div>
    </div>
    <div class="col-md-3"></div>
@endsection
