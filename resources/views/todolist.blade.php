@extends('layouts.app')

@section('content')
   
    <div class="lists-content">
        
  
        @if(count($lists)>0)
            <table>
                <tbody>
                    <tr>
                        <th>list_id</th>
                        <th>user_id</th>
                        <th>title</th>
                        <th></th>
                        <th></th>
                    </tr>
                     @foreach($lists as $list)
                     <tr>
                        <td style="width:10%">{{$list->id}}</td>
                        <td style="width:15%">{{$list->user_id}}</td>
                        <td style="width:20%"><a href="/lists/{{$list->id}}"</>{{$list->title}}</a></td>
                        <td style="width:10%"><a href="/lists/{{$list->id}}/delete">delete</a></td>
                         @if(count($list->tasks)>0)
                        <td style="width:20%"><a href="/lists/{{$list->id}}/zip">Zip list
                        @endif
                        </a></td>
                     <tr> 
                     @endforeach
                </tbody>   
            </table>
        @endif 
        
    </div>
   
   </br></br>

    <div class="add-list">

        {{ Form::open(array('url' => 'lists', 'method' => 'post')) }}  

            </br>
            {{Form::label('Add new list')}}
            {{Form::text('title'), Input::old('title')}}
            
            {{ Form::submit('Add new list') }}

        {{ Form::close() }}
    </div>
    


@endsection
