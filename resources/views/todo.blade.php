@extends('layouts.app')

@section('content')
   
    <div class="list-content">
    
        <div>{{$todo->title}}</div>
        
        @if(count($todo->tasks)>0)
	        <table>
		        <tbody>
		        	<tr>
		        		<th>task_id</th>
		        		<th>description</th>
		        		<th>created</th>
		        		<th>readed</th>
		        		<th></th>
		        	</tr>
		        	 @foreach($todo->tasks as $task)
		        	 <tr>
		        		<td style="width:10%">{{$task->id}}</td>
		        		<td style="width:15%">{{$task->description}}</td>
		        		<td style="width:15%">{{$task->created_at}}</td>
		        		<td class="flag" style="width:15%"><input type="checkbox" data-flag="status" data-url="/lists/{{$task->id}}/ajax" 
		        		@if($task->status=='readed')checked="checked">@endif</td>
		        		@if($task->delete == '0')
		        		<td style="width:35%"><a href="/tasks/{{$task->id}}/delete">delete</a></td>
		        		@endif
		        	 <tr> 
		        	 @endforeach
		        	<!--  <input type="checkbox" data-flag="status" data-url="http://kraktruck.localhost/manager/handle/flag/messages/2" checked="checked"> -->
		        </tbody>   
	        </table>
	        </br>
	        <button><a href="/lists/{{$todo->id}}/excel">Export tasks to excel</a></button>
        @endif 
    </div>

    </br></br>

    <div class="add-task">

    	{{ Form::open(array('url' => 'lists/'.$todo->id, 'method' => 'post')) }}  

			</br>
			{{Form::label('Add new task')}}
			{{Form::text('description'), Input::old('description')}}
		
			{{ Form::submit('Add new task') }}

		{{ Form::close() }}
    </div>

@endsection