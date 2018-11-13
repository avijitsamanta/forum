@extends('layouts.app')

@section('content')
   
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div style="text-align: left">Channels</div> 
                    <div style="text-align: right;">  
                        <a href="{{ route('channels.create') }}" class="btn btn-xs btn-primary">
                        Add
                        </a>
                    </div> 
                </div>

                <div class="panel-body">
                  <table class="table table-hover">

                    <thead>
                        
                        <th>
                            Name
                        </th>
                        <th>
                            Edit

                        </th>
                        <th>
                            Delete

                        </th>

                    </thead>

                    <tbody>
                        
                        @foreach($channels as $channel)

                        <tr>
                            <td> <a href="{{ route('channel',['slug'=>$channel->slug]) }}" style="text-decoration: none;">{{ $channel->title }}</a>  </td>

                            <td>
                                <a href="{{ route('channels.edit',['id'=>$channel->id]) }}" class="btn btn-xs btn-primary">
                                    Edit
                                </a>
                            </td>

                            <td>
                                
                                
                                <form action="{{ route('channels.destroy',['id'=>$channel->id]) }}" method="post">
                                    {{ csrf_field() }}

                                    {{ method_field('DELETE') }}

                                    <button class="btn btn-xs btn-danger">Delete</button>

                                </form>
                                    

                            </td>                            
                        </tr>

                        @endforeach
                    </tbody>
                      
                  </table>
                </div>
            </div>
       

@endsection
