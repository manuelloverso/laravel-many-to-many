@extends('layouts.admin')

@section('content')
    @include('partials.action-message')
    <div class=" mb-3 d-flex justify-content-between">

        <h3>Available Technologies</h3>
        <form class="d-flex align-items-center gap-3" action="{{ route('admin.technologies.store') }}" method="post">
            @csrf {{-- this is a laravel directive to protect your application from cross-site request forgery --}}

            @error('name', 'create')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            {{-- name input --}}
            <div class="">
                <input type="text" name="name" id="name"
                    class="form-control @error('name', 'create') is-invalid @enderror" placeholder="add the name"
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
                            {{-- MODAL TO DELETE THE ITEM --}}
                            <!-- Modal trigger button -->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#modalId-{{ $technology->id }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                            <!-- Modal Body -->
                            <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                            <div class="modal fade text-dark" id="modalId-{{ $technology->id }}" tabindex="-1"
                                data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                aria-labelledby="#modalTitleId-{{ $technology->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                    role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalTitleId-{{ $technology->id }}">
                                                Deleting '{{ $technology->name }}'
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">Are you sure you want to delete this technology? The
                                            action
                                            will
                                            be permanent</div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Close
                                            </button>
                                            <form action="{{ route('admin.technologies.destroy', $technology) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    Confirm
                                                </button>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
