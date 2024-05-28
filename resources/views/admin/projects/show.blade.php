@extends('layouts.admin')

@section('content')
    <div class="container py-4">
        @include('partials.action-message')

        <div class="col-4">
            <div class="card">
                <div class="card-img">
                    @if (str_starts_with($project->image, 'uploads/'))
                        <img class="w-100" src="{{ asset('storage/' . $project->image) }}" alt="">
                    @else
                        <img class="w-100" src="{{ $project->image }}" alt="">
                    @endif
                </div>
                <div class="card-body">
                    <h3>{{ $project->title }}</h3>
                    <p><strong>Description: </strong>{{ $project->description }}</p>
                    <p><strong>Type:
                        </strong>{{ $project->type ? $project->type->name : 'There are no types linked to this project' }}
                    </p>
                    <strong>Technologies: </strong>
                    @forelse ($project->technologies as $technology)
                        {{-- @dd($technology) --}}
                        <span class="badge bg-dark p-2">{{ $technology->name }}</span>
                    @empty
                        There are no technologies linked
                    @endforelse
                    <p><strong>Created: </strong>{{ $project->date }}</p>
                    <a class="btn btn-dark" href="{{ route('admin.projects.edit', $project) }}">Edit</a>
                    <x-delete-modal :item="$project" :name="'title'" :route="'projects'" />
                    <a class="btn btn-dark" href="{{ route('admin.projects.index') }}">Back</a>

                </div>
            </div>
        </div>
    </div>
@endsection
