<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($coworkingSpace) ? __('Edit Coworking Space') : __('Create Coworking Space') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Form  --}}
                    <form method="POST" action="{{ isset($coworkingSpace) ? route('coworking-spaces.update', $coworkingSpace->id) : route('coworking-spaces.store') }}">
                        
                        @csrf
                        @isset($coworkingSpace)
                            @method('PUT')
                        @endisset

                        <div class="form-group">
                          <label for="name">Name</label>
                          <input type="text" class="form-control" value="{{ isset($coworkingSpace) ? $coworkingSpace->name : '' }}" name="name" id="name" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                          <label for="description">Description</label>
                          <textarea class="form-control" name="description" id="description" rows="3">
                            {{ isset($coworkingSpace) ? $coworkingSpace->description : '' }}
                          </textarea>
                        </div>
                        <div class="text-right mt-3">
                            <button type="submit" class="btn btn-primary">
                                {{ isset($coworkingSpace) ? 'Update' : 'Save' }}
                            </button>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>    