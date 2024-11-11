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
                    
                    <div class="container mb-2">
                        <div class="row">
                            <div class="col-8">
                                @if (auth()->user()->isAdmin())
                                    <form method="GET" action="{{ route('admin.reservations') }}">
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <input type="text" name="search" class="form-control" placeholder="Search by coworking space" value="{{ request('search') }}">
                                            </div>
                                            <button type="submit" class="col-sm-2 btn btn-secondary ms-2">Search</button>
                                        </div>
                                    </form>
                                @endif
                                
                            </div>
                            <div class="col-4 text-right">
                                @if (!auth()->user()->isAdmin())
                                    <a href="{{ route('reservations.create') }}" type="button" class="btn btn-primary">Create</a>    
                                @endif
                            </div>
                        </div>   
                    </div>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                @if (auth()->user()->isAdmin())
                                    <th scope="col">User</th>
                                @endif
                                <th scope="col">Coworking Space</th>
                                <th scope="col">Reservation time</th>
                                <th scope="col">Status</th>
                                    
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservations as $reservation)
                                <tr>
                                    <th scope="row">{{ $reservation->id }}</th>
                                    @if (auth()->user()->isAdmin())
                                        <td>{{ $reservation->user->name }}</td>
                                    @endif
                                    <td>{{ $reservation->coworkingSpace->name }}</td>
                                    <td>{{ $reservation->reservation_time->format('d-m-Y H:i') }}</td>
                                    <td>
                                        @if (auth()->user()->isAdmin())
                                        <form method="POST" action="{{ route('admin.reservations.updateStatus', $reservation->id) }}" class="d-inline-flex align-items-center">
                                            @csrf
                                            <select class="form-select form-select-sm status-select me-2" name="status" data-reservation-id="{{ $reservation->id }}" style="width: auto;">
                                                <option value="Pending" {{ $reservation->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="Accepted" {{ $reservation->status == 'Accepted' ? 'selected' : '' }}>Accepted</option>
                                                <option value="Rejected" {{ $reservation->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                            </select>
                                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                        </form>   
                                        @else
                                            {{ $reservation->status }}
                                        @endif
                                    </td>
                                     
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
