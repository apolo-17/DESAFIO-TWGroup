<div class="text-right">
    <a href="{{ route('coworking-spaces.create') }}" type="button" class="btn btn-primary">Create</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Last</th>
        <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($spaces as $space)
        <tr>
            <th scope="row">{{ $space->id }}</th>
            <td>{{ $space->name }}</td>
            <td>{{ $space->description }}</td>
            <td>
                <a href="{{route('coworking-spaces.edit',$space->id)}}" type="button" class="btn btn-primary">Update</a>
                <form action="{{ route('coworking-spaces.destroy', $space->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>    
            </td>
        </tr>
    @endforeach
</table>