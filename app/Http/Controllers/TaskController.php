<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Task;
use App\ToDoList;
use Illuminate\Support\Facades\Auth;
use Session;
use Response;


class TaskController extends Controller
{

   public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        //dd('hit delete task');
        $tasks = Task::where('delete', 1)->get();
        return view('adminTasks', compact('tasks'));
    
    }

    public function store(Request $request, ToDoList $todo)
    {
    	//return $todo;
        $validator = $this->validate($request, [
            'description' => 'required|max:255'
        ]);
        
    	$task = new Task;
    	$task->description = $request->description;

    	$todo->tasks()->save($task);
    	return back();
        //dd($request->all());
	}

    public function destroy($id)
    {
        //dd(Auth::user()->role);

        $task = Task::find($id);
        if(Auth::user()->role == 1){
            $task->delete();
            Session::flash('message', 'Successfully deleted the task!');
            return back();
        }
            $task->delete = 1;
            $task->update();
            return back();
        
        

        //dd($task);
        //dd('hit destroy list');
    }

    public function ajax(Request $request, $id)
    {
       
        $data = $request->all();
        //dd($data['flag']);

        if($data['flag'] !== 'status'){
            dd("falg check");
            return redirect()->to('lists');
        }

        $task = Task::find($id);
        //dd($task);
        $task->status = $request->value;
        $task->update();
        return response()->json(['success' => 'success message']);

    }

}
