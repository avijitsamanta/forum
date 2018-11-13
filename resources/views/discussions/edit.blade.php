@extends('layouts.app')

@section('content')

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
                <div class="panel-heading">Update discussion</div>

                <div class="panel-body">
                   <form  action = "{{ route('discussions.update',['id'=>$discussion->id]) }}" method="post">

                       {{ csrf_field() }}

                       <div class="form-group">

                            <label for="title">Content</label>

                            <textarea name="content" id="content" cols="30" rows="10" class="form-control">{{ $discussion->content }}</textarea> 

                       </div>

                       <div class="form-group">

                           <button class="btn btn-success pull-right" type="submit">Save Discussion Changes</button>
                            
                       </div>

                   </form>
                </div>
            </div>
      

@endsection
