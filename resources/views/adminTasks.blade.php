@extends('layouts.app')

@section('content')
   
    <div class="list-content">
    
      
       <!--  {{$tasks}} -->

	     
	     	<table>
	     		 <table>
	     		 @if(count($tasks)>0)
			        <tbody>
			        	<tr>
			        		<th>task_id</th>
			        		<th>description</th>
			        		<th>created</th>
			        		<th>readed</th>
			        		<th></th>
			        	</tr>
			        	 @foreach($tasks as $task)
				        	 <tr>
				        		<td style="width:10%">{{$task->id}}</td>
				        		<td style="width:15%">{{$task->description}}</td>
				        		<td style="width:15%">{{$task->created_at}}</td>
				        		<td class="flag" style="width:15%"><input type="checkbox" data-flag="status" data-url="/lists/{{$task->id}}/ajax" 
				        		@if($task->status=='readed')checked="checked">@endif</td>
				        		<td style="width:35%"><a href="/tasks/{{$task->id}}/delete">delete</a></td>
				        		
				        	 <tr> 
			        	 @endforeach
			        </tbody> 
			    @endif  
	     	</table>
	    

	    </br>
	      
      
    </div>

    </br></br>

   

@endsection