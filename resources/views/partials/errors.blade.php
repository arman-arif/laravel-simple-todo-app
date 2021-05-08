@if (count($errors->all()))
    <div class="alert alert-danger mb-0">
        <ul class="my-0 py-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif