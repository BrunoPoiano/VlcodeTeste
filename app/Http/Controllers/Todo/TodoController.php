<?php

namespace App\Http\Controllers\Todo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Todo\ListTodoResource;
use Illuminate\Support\Facades\Log;

class TodoController extends Controller
{
    public function createTodo(Request $request){

        $request->validate([
            'name' => 'required|string',
            'date' => 'required|string'
        ]);

        Todo::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'date' => $request->date,
        ]);

        return response([], 200);
    }

    public function listToDos(Request $request){
        $todos = Todo::where('user_id', Auth::user()->id);
        
        
        if(isset($request->search) && $request->search){
            $todos->where('name', 'like', "%{$request->search}%");
        }
        if(isset($request->orderBy) && $request->orderBy){
            $todos->orderBy($request->orderBy);
        }
        if(isset($request->status) ){
            if($request->status != 3){
                $todos->where('status', $request->status);
            }
        }
        if(isset($request->startDate) && $request->startDate){
            $todos->where('date', '>=',  $request->startDate);
        }
        if(isset($request->endDate) && $request->endDate){
            $todos->where('date', '>=',  $request->endDate);
        }
        

        $todos = ListTodoResource::collection($todos->get());

        return response($todos, 200);
    }

    public function updateTodo(Request $request, Todo $todo, $status ){

        if(empty($todo)){
            return response(['error' => 'to do not found']);
        }

        if($todo->user_id != Auth::user()->id){
            return response(['error' => 'this is not your to do ']);
        }

        $todo->status = $status;
        $todo->update();
        return response([], 200);
    }

    public function deleteTodo(Request $request, Todo $todo ){

        if(empty($todo)){
            return response(['error' => 'to do not found']);
        }

        if($todo->user_id != Auth::user()->id){
            return response(['error' => 'this is not your to do ']);
        }

        $todo->is_done = true;
        $todo->delete();
        return response([], 200);
    }
}
