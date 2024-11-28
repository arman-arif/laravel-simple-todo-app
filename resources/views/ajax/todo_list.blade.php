@foreach ($tasks as $task)

    <tr>
        <td>
            @if ($task->done)
                <a href="{{ route('ajax.update', $task->id) }}" class="text-success update-item">
                    <i class="far fa-check-circle"></i>
                </a>
            @else
                <a href="{{ route('ajax.update', $task->id) }}" class="text-warning update-item">
                    <i class="far fa-circle"></i>
                </a>
            @endif

        </td>
        <td>{{ $task->task }}</td>
        <td class="text-muted">{{ $task->updated_at->diffForHumans() }}</td>
        <td class="text-end pr-2">
            <a href="{{ route('ajax.delete', $task->id) }}" title="Remove" class="text-danger delete-item">
                <i class="far fa-trash-alt"></i>
            </a>
        </td>
    </tr>

@endforeach
