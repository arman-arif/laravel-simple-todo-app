<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;

class TodoAjaxController extends Controller
{

    public function index()
    {
        $tasks = Todo::all()->sortByDesc('updated_at');
        return view('ajax.index',compact('tasks'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'task' => 'required|min:5|max:35|string'
        ]);
        $todo = new Todo();
        $todo->task = $request->task;
        $todo->save();

        return [
            'message' => 'New ToDo task listed successfully',
            'data' => array_merge($todo->toArray(), [
                'update_url' => route('ajax.update', $todo->id),
                'delete_url' => route('ajax.delete', $todo->id),
                'difference' => $todo->updated_at->diffForHumans(),
            ]),
        ];
    }


    public function update($id)
    {
        $todo = Todo::find($id);
        $todo->done == 0 ? $todo->done = 1 : $todo->done = 0;
        $todo->save();

        return [
            'message' => 'Task successfully listed as complete.',
        ];
    }


    public function delete($id)
    {
        $todo = Todo::find($id);
        $todo->delete();

        return [
            'message' => 'Task removed successfully',
        ];
    }

    public function list() {
        $tasks = Todo::all()->sortByDesc('updated_at');

        return [
            'pending' => view('ajax.todo_list', [
                'tasks' => $tasks->where('done', 0),
            ])->render(),
            'completed' => view('ajax.todo_list', [
                'tasks' => $tasks->where('done', 1),
            ])->render(),
        ];
    }
}
