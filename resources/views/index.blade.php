@extends('layouts.app')

@section('title', 'ToDo')

@section('content')
    @if (Session::has('message'))
        <p class="alert alert-success text-center">
            {{ Session::get('message') }}
        </p>
    @endif
    <form action="{{ route('store') }}" method="post" class="my-md-4 my-sm-3">
        <div class="input-group">
            @csrf
            <span class="input-group-text">What ToDo</span>
            <input type="text" class="form-control" name="task" placeholder="What are you going To Do!" maxlength="40"
                autofocus>
            <button class="btn btn-outline-secondary" type="submit">+ Add</button>
        </div>
    </form>
    @include('layouts.errors')
    <div class="border rounded p-3 mb-3 overflow-auto" style="height: 300px">
        <table class="table table-hover">
            @foreach ($tasks as $task)
                @if (!$task->done)
                    <tr>
                        <td>
                            @if ($task->done)
                                <a href="{{ route('update', $task->id) }}" class="text-success"><i
                                        class="far fa-check-circle"></i></a>
                            @else
                                <a href="{{ route('update', $task->id) }}" class="text-warning"><i
                                        class="far fa-circle"></i></a>
                            @endif

                        </td>
                        <td>{{ $task->task }}</td>
                        <td class="text-muted">{{ $task->updated_at->diffForHumans() }}</td>
                        <td class="text-end pr-2">
                            <a href="{{ route('delete', $task->id) }}" title="Remove" class="text-danger"><i
                                    class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>
                @endif
            @endforeach
        </table>
    </div>
    <div class="font-weight-bold MT-2">Completed Tasks</div>
    <div class="p-3 border rounded overflow-auto" style="height: 250px">
        <table class="table table-hover">
            @foreach ($tasks as $task)
                @if ($task->done)
                    <tr>
                        <td>
                            @if ($task->done)
                                <a href="{{ route('update', $task->id) }}" class="text-success"><i
                                        class="far fa-check-circle"></i></a>
                            @else
                                <a href="{{ route('update', $task->id) }}" class="text-warning"><i
                                        class="far fa-circle"></i></a>
                            @endif

                        </td>
                        <td>{{ $task->task }}</td>
                        <td class="text-muted">{{ $task->updated_at->diffForHumans() }}</td>
                        <td class="text-end pr-2">
                            <a href="{{ route('delete', $task->id) }}" title="Remove" class="text-danger"><i
                                    class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>
                @endif
            @endforeach
        </table>
    </div>
    </fieldset>
@endsection
