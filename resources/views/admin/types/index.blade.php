@extends('layouts.admin')

@section('content')
    @include('partials.action-message')
    <div class=" mb-3 d-flex justify-content-between">

        <h3 class="text-secondary">Available Types</h3>
        <form class="d-flex align-items-center gap-3" action="{{ route('admin.types.store') }}" method="post">
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
                Add Type
            </button>

        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-secondary">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($types as $type)
                    <tr class="">
                        <td scope="row"><strong>{{ $type->id }}</strong></td>
                        {{-- Edit / Name Row --}}
                        @if (isset($editing_type) && $editing_type->id == $type->id)
                            <td>
                                <form class="d-flex gap-2 align-items-start"
                                    action="{{ route('admin.types.update', $type) }}" method="post">
                                    @csrf {{-- this is a laravel directive to protect your application from cross-site request forgery --}}
                                    @method('PUT')

                                    {{-- name input --}}
                                    <div>
                                        <input type="text" name="name" id="name"
                                            class="form-control @error('name', 'update') is-invalid @enderror"
                                            placeholder="add the name" value="{{ old('name', $type->name) }}" />
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
                            <td>{{ $type->name }}</td>
                        @endif


                        <td>
                            @if (isset($editing_type) && $editing_type->id == $type->id)
                                <a class="btn btn-danger" href="{{ route('admin.types.index') }}">
                                    <i class="fa-solid fa-delete-left"></i>
                                </a>
                            @else
                                <a class="btn btn-dark" href="{{ route('admin.types.edit', $type) }}">
                                    <i class="fa-solid fa-pencil "></i>
                                </a>
                            @endif
                            <x-delete-modal :item="$type" :name="'name'" :route="'types'" />
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
