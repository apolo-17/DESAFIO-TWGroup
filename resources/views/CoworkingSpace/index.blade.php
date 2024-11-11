<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reservations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
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

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
