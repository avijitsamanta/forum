@extends('layouts.app')

@section('content')


            <div class="panel panel-default">
                <div class="panel-heading">
                    
                    <div style="text-align: left">Edit channel</div> 
                    <div style="text-align: right;">  
                        <a href="{{ route('channels.index') }}" class="btn btn-xs btn-primary">
                        Back
                        </a>
                    </div> 


                </div>

                <div class="panel-body">
                    <form action="{{ route('channels.update',['id'=>$channel->id])}}" method="post">
                    	{{ csrf_field() }}

						{{ method_field('PUT') }}

                    	<div class="form-group">
                    		<input type="text" name="channel" class="form-control" value="{{ $channel->title }}">
                    	</div>

                        <div class="form-group">

                            <div class="text-center">
                                
                                <button class="btn btn-success" type="submit">
                                    
                                    Edit channel

                                </button>

                            </div>
                            

                        </div>

                    </form>
                </div>
            </div>
    

@endsection
