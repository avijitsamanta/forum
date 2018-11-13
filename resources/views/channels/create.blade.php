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
       
        <div class="panel-heading">
                
                <div style="text-align: left">Cretae a new channel</div> 
                    <div style="text-align: right;">  
                        <a href="{{ route('channels.index') }}" class="btn btn-xs btn-primary">
                        Back
                        </a>
                    </div> 

        </div>

        <div class="panel-body">
            <form action="{{ route('channels.store')}}" method="post">
            	{{ csrf_field() }}

            	<div class="form-group">
            		<input type="text" name="channel" class="form-control">
            	</div>

                <div class="form-group">

                    <div class="text-center">
                        
                        <button class="btn btn-success" type="submit">
                            
                            Save channel

                        </button>

                    </div>
                    

                </div>

            </form>
        </div>

    </div>

@endsection
