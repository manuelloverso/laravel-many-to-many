@extends('layouts.admin')

@section('content')
    @include('partials.action-message')
    <div class=" mb-3 d-flex justify-content-between">

        <h3 class="text-secondary">Available Technologies</h3>
        <form class="d-flex align-items-center gap-3" action="{{ route('admin.technologies.store') }}" method="post">
            @csrf {{-- this is a laravel directive to protect your application from cross-site request forgery --}}

            @error('name', 'create')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            {{-- name input --}}
            <div class="">
                <input type="text" name="name" id="name"
                    class="form-control @error('name', 'create') is-invalid @enderror" placeholder="Name"
                    value="{{ old('name') }}" />
            </div>

            <button type="submit" class="btn btn-primary">
                Add Technology
            </button>

        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-secondary">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Associated Projects</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($technologies as $technology)
                    <tr class="">

                        {{-- Edit / Name Row --}}
                        <td scope="row"><strong>{{ $technology->id }}</strong></td>
                        @if (isset($editing_tech) && $editing_tech->id == $technology->id)
                            <td>
                                <form class="d-flex gap-2 align-items-start"
                                    action="{{ route('admin.technologies.update', $technology) }}" method="post">
                                    @csrf {{-- this is a laravel directive to protect your application from cross-site request forgery --}}
                                    @method('PUT')

                                    {{-- name input --}}
                                    <div>
                                        <input type="text" name="name" id="name"
                                            class="form-control @error('name', 'update') is-invalid @enderror"
                                            placeholder="add the name" value="{{ old('name', $technology->name) }}" />
                                        @error('name', 'update')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        Save
                                    </button>
                                </form>
                            </td>
                        @else
                            <td>{{ $technology->name }}</td>
                        @endif

                        {{-- Number of linked projects --}}
                        <td>{{ count($technology->projects) }}</td>

                        {{-- Action Buttons --}}
                        <td>
                            @if (isset($editing_tech) && $editing_tech->id == $technology->id)
                                <a class="btn btn-danger" href="{{ route('admin.technologies.index') }}">
                                    <i class="fa-solid fa-delete-left"></i>
                                </a>
                            @else
                                <a class="btn btn-dark" href="{{ route('admin.technologies.edit', $technology) }}">
                                    <i class="fa-solid fa-pencil "></i>
                                </a>
                            @endif

                            {{-- delete modal button --}}
                            <x-delete-modal :item="$technology" :name="'name'" :route="'technologies'" />
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
