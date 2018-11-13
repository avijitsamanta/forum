@extends('layouts.app')

@section('content')

	<div class="panel panel-default">
		<div class="panel-heading">
			<img src="{{ $discussion->user->avatar }}" width="70px" height="70px">&nbsp;&nbsp;&nbsp;
			<span> {{ $discussion->user->name }}({{ $discussion->user->points }}), <b>{{ $discussion->created_at->diffForHumans() }}</b></span>

			@if($discussion->hasBestAnswer())

				<span class="btn btn-xs btn-success pull-right" style="margin-left: 8px">closed</span>

			@else

				<span class="btn btn-xs btn-danger pull-right" style="margin-left: 8px">open</span>

			@endif

			@if(Auth::id() === $discussion->user_id)

				@if(!$discussion->hasBestAnswer())

					<a href="{{ route('discussions.edit',['slug'=>$discussion->slug]) }}" class="pull-right btn btn-default btn-xs" style="margin-left: 8px">Edit</a>

				@endif

			@endif

			@if($discussion->is_watched_by_auth_user())
			
				<a href="{{ route('discussions.unwatch',['id'=>$discussion->id]) }}" class="pull-right btn btn-default btn-xs">Unwatch</a>

			@else

				<a href="{{ route('discussions.watch',['id'=>$discussion->id]) }}" class="pull-right btn btn-default btn-xs">Watch</a>

			@endif
			
		</div>

		<div class="panel-body">
			<h5 class="text-center"><b>{{ $discussion->title }}</b></h5>
			<p class="text-center">
				{!! Markdown::convertToHtml($discussion->content) !!}     
			</p>
			<hr>
			
			@if($best_answer)

			<div class="text-center">

				<h3 class="text-center">BEST ANSWER</h3>

				<div class="panel panel-success">

					<div class="panel-heading">
						
						<img src="{{ $best_answer->user->avatar }}" width="70px" height="70px">&nbsp;&nbsp;&nbsp;
						<span> {{ $best_answer->user->name }}({{ $best_answer->user->points }})</span>


					</div>

					<div class="panel-body">

						{!! Markdown::convertToHtml($best_answer->content) !!}     
						
					</div>
					
				</div>
				
			</div>

			@endif
		</div>

		<div class="panel-footer">

			 <span> {{ $discussion->replies->count() }} Replies </span>

             <a href="{{ route('channel',['slug'=>$discussion->channel->slug])}}" class="btn btn-default pull-right btn-xs">{{ $discussion->channel->title }}</a>

		</div>
	</div>

    @foreach($discussion->replies as $r)
	
		<div class="panel panel-default">
			<div class="panel-heading">
				<img src="{{ $r->user->avatar }}" width="70px" height="70px">&nbsp;&nbsp;&nbsp;
				<span> {{ $r->user->name }}({{ $r->user->points }}), <b>{{ $r->created_at->diffForHumans() }}</b></span>

				@if(!$best_answer)

					@if(Auth::id() === $discussion->user->id )

						<a href="{{ route('reply.best.answer',['id'=>$r->id]) }}" class="btn btn-info pull-right" style="margin-left: 8px">Mark as Best Answer</a>

					@endif

				@endif

				@if(Auth::id() === $discussion->user->id )

					@if(!$r->best_answer)

						<a href="{{ route('replies.edit',['id'=>$r->id]) }}" class="btn btn-info pull-right">Edit</a>

					@endif

				@endif

			</div>

			<div class="panel-body">
				
				<p class="text-center">
					{!! Markdown::convertToHtml($r->content) !!}
				</p>
			</div>

			<div class="panel-footer">

				@if($r->is_liked_by_auth_user())

				<a href="{{ route('reply.unlike',['id'=>$r->id]) }}" class="btn btn-danger btn-xs">Unlike<span class="badge">{{ $r->likes->count() }}</span></a>

				@else
				
				<a href="{{ route('reply.like',['id'=>$r->id]) }}" class="btn btn-success btn-xs">Like <span class="badge">{{ $r->likes->count() }}</span></a>

				@endif



			</div>
		</div>

    @endforeach

    @if(count($errors)>0)

        <ul class="list-group">

        @foreach($errors->all() as $error)

            <li class="list-group-item text-danger">
                
                {{ $error }}

            </li>

        @endforeach    

        </ul>

    @endif

    <div class="panel panel-default">
			<div class="panel-heading">
				
				<span> <b>Leave a Reply</b></span>

			</div>

			@if(Auth::check())

			<div class="panel-body">

				<form action="{{ route('discussions.reply',['id'=>$discussion->id]) }}" method="post">
					{{ csrf_field() }}

					<div class="form-group">

						<label for="reply"></label>

						<textarea class="form-control" name="reply" id="reply" rows="10" cols="30"> </textarea>
						

					</div>

					<div class="form-group">

						<button class="btn pull-right" type="submit">Leave a Reply</button>

					</div>

				</form>
				
				
			</div>

			@else

			<div class="text-center">
				
				<h2>Sign in to leave a reply</h2>

			</div>

			@endif
		</div>

@endsection
