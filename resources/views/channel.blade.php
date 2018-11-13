@extends('layouts.app')

@section('content')
            
            @foreach($discussions as $discussion)
        
            <div class="panel panel-default">
                <div class="panel-heading">
                    <img src="{{ $discussion->user->avatar }}" width="70px" height="70px">&nbsp;&nbsp;&nbsp;
                    <span> {{ $discussion->user->name }}, <b>{{ $discussion->created_at->diffForHumans() }}</b></span>

                     @if($discussion->hasBestAnswer())

                    <span class="btn btn-xs btn-success pull-right" style="margin-left: 8px">closed</span>
                    
                    @else

                    <span class="btn btn-xs btn-danger pull-right" style="margin-left: 8px">open</span>

                    @endif
                    
                    <a href="{{ route('discussion',['slug'=>$discussion->slug]) }}" class="btn btn-default pull-right btn-xs">View</a>

                </div>

                <div class="panel-body">
                    <h5 class="text-center"><b>{{ $discussion->title }}</b></h5>
                    <p class="text-center">
                        {{ str_limit($discussion->content,50) }}     
                    </p>
                </div>

                <div class="panel-footer">

                     <span> {{ $discussion->replies->count() }} Replies </span>

                    <a href="{{ route('channel',['slug'=>$discussion->channel->slug])}}" class="btn btn-default pull-right btn-xs">{{ $discussion->channel->title }}</a>
                    
                </div>
            </div>

            @endforeach

            <div class="text-center">
                
                {{ $discussions->links() }}

            </div>
      

@endsection
