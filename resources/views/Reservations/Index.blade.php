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
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">User</th>
                            <th scope="col">Coworking Space</th>
                            <th scope="col">Reservation time</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservations as $reservation)
                            <tr>
                                <th scope="row">{{ $reservation->id }}</th>
                                <td>{{ $reservation->user->name }}</td>
                                <td>{{ $reservation->coworkingSpace->name }}</td>
                                <td>{{ $reservation->reservation_time->format('d-m-Y H:i') }}</td>
                                <td>{{ $reservation->status }}</td>
                                <td>
                                    <a href="{{route('admin.reservations.updateStatus',$reservation->id)}}" type="button" class="btn btn-primary">Update</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
