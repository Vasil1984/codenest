<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;

use App\ToDoList;
use Illuminate\Support\Facades\Auth;
use Session;
use Excel;
use Zipper;
use File;

//use App\Task;




class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {

        $lists = ToDoList::with('tasks')->get();
        return view('todolist', compact('lists'));
        
        
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('todoregister');
        //dd('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd(Auth::user()->id);
        $validator = $this->validate($request, [
            'title' => 'required|max:255'
        ]);

        $todolist = new ToDoList;
        $todolist->title = $request->title;
        $todolist->user_id = Auth::user()->id;
        //dd($todolist);
        $todolist->save();
        return back(); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ToDoList $todo)
    {
        //echo $comment->post->title;
        //dd($todo->tasks);
        return view('todo', compact('todo'));
        //dd($todolist->tasks);
    }

      /**
     * Export tasks to excel.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function excel(ToDoList $todo)
    {

        $tasksArray = []; 
        $tasksArray[] = ['task_id', 'list_id', 'description','status','created_at', 'updated_at'];

        foreach ($todo->tasks as $task) {
            $tasksArray[] = $task->toArray();
        }
        //dd($todo);
        Excel::create($todo->title, function($excel) use ($tasksArray) {

            $excel->setTitle('Tasks');
            $excel->setCreator('Laravel')->setCompany('CodeNest');
            $excel->setDescription('tasks file');

            $excel->sheet('sheet1', function($sheet) use ($tasksArray) {
                $sheet->fromArray($tasksArray, null, 'A1', false, false);
            });

        })->download('xlsx');

        return back();
    }

    public function zip(ToDoList $todo)
    {

        // delete existing files
        File::deleteDirectory('storage/exports', true);
        File::deleteDirectory(base_path('storage/exports'), true);

        
        $todo = ToDoList::with('tasks')->where('id',$todo->id )->get();
        $tasks = $todo['0']->tasks;
        // check for task
        if(count($tasks)<1){
            return redirect()->to('/lists');
        }

        // prepare tasks for excel
        $tasksArray = []; 
        $tasksArray[] = ['task_id', 'list_id', 'description','status','created_at', 'updated_at'];
        
      
        foreach ($tasks as $task) {
            $tasksArray[] = $task->toArray();
        }
        Excel::create($todo['0']->title, function($excel) use ($tasksArray, $todo) {

            $excel->setTitle($todo['0']->title);
            $excel->setCreator('Laravel')->setCompany('CodeNest');
            $excel->setDescription($todo['0']->title);

            $excel->sheet('sheet1', function($sheet) use ($tasksArray) {
                $sheet->fromArray($tasksArray, null, 'A1', false, false);
            });

        })->store('xlsx' );

        // make zip 
        $files = glob(storage_path().'\exports\\*');
        Zipper::make('storage/exports/zips/'.$todo['0']->title.'.zip')->add($files)->close();
    
        return response()->download('storage/exports/zips/'.$todo['0']->title.'.zip');
        

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd('edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ToDoList $todolist)
    {
        //dd($request->description);
        //dd($todolist);  //tasks
        /*$todolist->tasks = $request->description;
        $todolist->save();*/

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //dd('hit list destroy ');
        $todo = ToDoList::find($id);
        $todo->tasks()->delete();
        $todo->delete();
        Session::flash('message', 'Successfully deleted the list!');
        return back();
    }
}
