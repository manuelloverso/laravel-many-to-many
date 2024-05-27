@extends('layouts.admin')

@section('content')
    <h1>Edit {{ $type->name }} type</h1>
    @include('partials.validate-errors')
    <form action="{{ route('admin.types.update', $type) }}" method="post">
        @csrf {{-- this is a laravel directive to protect your application from cross-site request forgery --}}
        @method('PUT')

        {{-- name input --}}
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                placeholder="add the name" value="{{ old('name', $type->name) }}" />
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">
            Submit
        </button>
    </form>
@endsection
