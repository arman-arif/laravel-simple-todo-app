<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Todo::all()->sortByDesc('updated_at');
        return view('index',compact('tasks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'task' => 'required|min:5|max:35|string'
        ]);
        $todo = new Todo();
        $todo->task = $request->task;
        $todo->save();

        return redirect()
            ->route('index')
            ->with('message','New ToDo task listed successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $todo = Todo::find($id);
        $todo->done == 0 ? $todo->done = 1 : $todo->done = 0;
        $todo->save();

        return redirect()
            ->route('index')
            ->with('message','Task successfully listed as complete');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $todo = Todo::find($id);
        $todo->delete();

        return redirect()
            ->route('index')
            ->with('message','Task removed successfully');
    }
}
