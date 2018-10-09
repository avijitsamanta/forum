@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Cretae a new channel</div>

                <div class="panel-body">
                    <form action="{{ route('channels.store')}}" >
                    	{{ csrf_field() }}

                    	<div class="form-group">
                    		<input type="text" name="channel" class="form-control">
                    	</div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
