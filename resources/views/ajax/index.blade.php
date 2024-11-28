@extends('layouts.app')

@section('title', 'ToDo')

@section('content')

    <p class="alert alert-success text-center" id="successMessage" style="display: none"></p>

    <form action="{{ route('ajax.store') }}" method="post" class="my-md-4 my-sm-3" id="todoForm">
        <div class="input-group">
            @csrf
            <span class="input-group-text">What ToDo</span>
            <input type="text" class="form-control" name="task" placeholder="What are you going To Do!" maxlength="35" autofocus>
            <button class="btn btn-outline-secondary" type="submit">+ Add</button>
        </div>
    </form>
    @include('partials.errors')
    <div class="border rounded p-3 mb-3 overflow-auto" style="height: 300px">
        <table class="table table-hover" id="taskListTable">
            @include('ajax.todo_list', ['tasks' => $tasks->where('done', 0)])
        </table>
    </div>
    <div class="font-weight-bold MT-2">Completed Tasks</div>
    <div class="p-3 border rounded overflow-auto" style="height: 250px">
        <table class="table table-hover" id="completedListTable">
            @include('ajax.todo_list', ['tasks' => $tasks->where('done', 1)])
        </table>
    </div>
    </fieldset>
@endsection

@push('js')
<script src="{{ asset('js/todo-ajax.js') }}?id={{ time() }}"></script>
@endpush
