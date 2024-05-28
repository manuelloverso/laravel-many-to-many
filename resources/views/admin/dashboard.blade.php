@extends('layouts.admin')

@section('content')
    <h2 class="text-secondary mb-3">Dashboard</h2>
    {{-- Projects Table --}}
    <div class="accordion mb-3">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed fs-4" type="button" data-bs-toggle="collapse"
                    data-bs-target="#projects" aria-expanded="false" aria-controls="projects">
                    Projects
                </button>
            </h2>
            <div id="projects" class="accordion-collapse collapse" data-bs-parent="#projects">
                <div class="accordion-body">
                    <a class="btn btn-dark mb-3" href="{{ route('admin.projects.index') }}">Actions</a>
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
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($projects as $project)
                                    <tr class="">
                                        <td scope="row"><strong>{{ $project->id }}</strong></td>
                                        <td>{{ $project->title }}</td>
                                        <td>
                                            @if (str_starts_with($project->image, 'uploads/'))
                                                <img height="80" width="150"
                                                    src="{{ asset('storage/' . $project->image) }}" alt="">
                                            @else
                                                <img height="80" width="150" src="{{ $project->image }}"
                                                    alt="">
                                            @endif
                                        </td>
                                        <td style="max-width: 200px" class="truncate">{{ $project->description }}</td>
                                        <td>{{ $project->type ? $project->type->name : 'There are no types linked to this project' }}
                                        </td>
                                        <td>{{ $project->date }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">Nothing to show here</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        {{-- technologies Table --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed fs-4" type="button" data-bs-toggle="collapse"
                    data-bs-target="#technologies" aria-expanded="false" aria-controls="technologies">
                    Technologies
                </button>
            </h2>
            <div id="technologies" class="accordion-collapse collapse" data-bs-parent="#technologies">
                <div class="accordion-body">
                    <a class="btn btn-dark mb-3" href="{{ route('admin.technologies.index') }}">Actions</a>
                    <div class="table-responsive">
                        <table class="table table-hover table-secondary">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Associated Projects</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($technologies as $technology)
                                    <tr class="">

                                        <td scope="row"><strong>{{ $technology->id }}</strong></td>
                                        <td>{{ $technology->name }}</td>

                                        {{-- Number of linked projects --}}
                                        <td>{{ count($technology->projects) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">Nothing to show here</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- types Table --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed fs-4" type="button" data-bs-toggle="collapse"
                    data-bs-target="#types" aria-expanded="false" aria-controls="types">
                    Types
                </button>
            </h2>
            <div id="types" class="accordion-collapse collapse" data-bs-parent="#types">
                <div class="accordion-body">
                    <a class="btn btn-dark mb-3" href="{{ route('admin.types.index') }}">Actions</a>
                    <div class="table-responsive">
                        <table class="table table-hover table-secondary">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($types as $type)
                                    <tr class="">

                                        <td scope="row"><strong>{{ $type->id }}</strong></td>
                                        <td>{{ $type->name }}</td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">Nothing to show here</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
