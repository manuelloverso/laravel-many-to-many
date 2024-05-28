@extends('layouts.admin')


@section('content')
    {{-- Projects --}}

    {{-- right-side , main content --}}
    @include('partials.action-message')

    {{-- heading --}}
    <div class=" mb-3 d-flex justify-content-between">
        <h3 class="text-secondary">My Projects</h3>
        <a class="btn btn-primary" href="{{ route('admin.projects.create') }}">Create</a>
    </div>

    {{-- table --}}
    <div class="table-responsive">
        <table class="table table-hover table-secondary">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Image</th>
                    <th scope="col">Description</th>
                    <th scope="col">Type</th>
                    <th scope="col">Date</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($projects as $project)
                    <tr class="">
                        <td scope="row"><strong>{{ $project->id }}</strong></td>
                        <td>{{ $project->title }}</td>
                        <td>
                            @if (str_starts_with($project->image, 'uploads/'))
                                <img height="80" width="150" src="{{ asset('storage/' . $project->image) }}"
                                    alt="">
                            @else
                                <img height="80" width="150" src="{{ $project->image }}" alt="">
                            @endif
                        </td>
                        <td style="max-width: 200px" class="truncate">{{ $project->description }}</td>
                        <td>{{ $project->type ? $project->type->name : 'There are no types linked to this project' }}
                        </td>
                        <td>{{ $project->date }}</td>

                        {{-- action buttons --}}
                        <td>
                            <a class="btn btn-dark" href="{{ route('admin.projects.show', $project) }}"><i
                                    class="fa-solid fa-eye "></i></a>
                            <a class="btn btn-dark" href="{{ route('admin.projects.edit', $project) }}"><i
                                    class="fa-solid fa-pencil "></i></a>
                            {{-- delete modal button --}}
                            <x-delete-modal :item="$project" :name="'title'" :route="'projects'" />
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">Nothing to show here</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
