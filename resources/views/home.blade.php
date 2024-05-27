@extends('layouts.app')
@section('content')
    <div class="container py-4">
        <div class="row row-cols-3 gy-3">
            @foreach ($projects as $project)
                <div class="col">
                    <div class="card h-100">
                        <div class="card-img">
                            @if (str_starts_with($project->image, 'uploads/'))
                                <img class="w-100" src="{{ asset('storage/' . $project->image) }}" alt="">
                            @else
                                <img class="w-100" src="{{ $project->image }}" alt="">
                            @endif
                        </div>
                        <div class="card-body">
                            <h3 class="text-uppercase">{{ $project->title }}</h3>
                            <p><strong>Type:
                                </strong>{{ $project->type ? $project->type->name : 'There are no types linked to this project' }}
                            </p>
                            <p><strong>Description: </strong>{{ $project->description }}</p>
                            <p><strong>Created: </strong>{{ $project->date }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
