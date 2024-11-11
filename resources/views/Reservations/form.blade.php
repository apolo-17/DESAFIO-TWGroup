<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Reservation') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Form  --}}
                    <form method="POST" action="{{ route('reservations.store') }}">
                        
                        @csrf

                        <div class="form-group">
                            <label for="reservation_time">Reservation time</label>
                            <input type="datetime-local" class="form-control" name="reservation_time" id="reservation_time" value="{{ old('reservation_time') }}" required>
                          </div>
                          <div class="form-group">
                            <label for="coworking_space_id">Example select</label>
                            <select class="form-control" name="coworking_space_id" id="coworking_space_id" required>
                              
                              @foreach ($coworking_spaces as $space )
                                <option value="{{ $space->id }}" {{ old('coworking_space_id') == $space->id ? 'selected' : '' }}>{{ $space->name }}</option>
                              @endforeach
                            </select>
                            
                            @error('reservation_time')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                          </div>
                        <div class="text-right mt-3">
                            <button type="submit" class="btn btn-primary">
                                Save
                            </button>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>    