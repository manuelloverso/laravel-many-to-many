@extends('layouts.admin')

@section('content')
    <h1>Add a new Project</h1>
    @include('partials.validate-errors')
    <form action="{{ route('admin.projects.store') }}" method="post" enctype="multipart/form-data">
        @csrf {{-- this is a laravel directive to protect your application from cross-site request forgery --}}

        {{-- title input --}}
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                placeholder="add the title" value="{{ old('title') }}" />
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Image input --}}
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" id="image" class="form-control  @error('image') is-invalid @enderror"
                placeholder="add an image" value="{{ old('image') }}" />
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Type Input --}}
        <div class="mb-3">
            <label for="type_id" class="form-label">Type</label>
            <select class="form-select form-select" name="type_id" id="type_id">
                <option disabled selected>Select a type</option>
                @foreach ($types as $type)
                    <option class="text-uppercase" {{ $type->id == old('type_id') ? 'selected' : '' }}
                        value="{{ $type->id }}">
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
            @error('type_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Technologies input --}}
        <label for="technologies" class="form-label">Technologies</label>
        <div class="mb-3 d-flex gap-4">
            @foreach ($technologies as $technology)
                <div class="form-check">
                    <input name="technologies[]" class="form-check-input" type="checkbox" value="{{ $technology->id }}"
                        id="technology-{{ $technology->id }}"
                        {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }} />
                    <label class="form-check-label" for="technology-{{ $technology->id }}"> {{ $technology->name }}
                    </label>
                </div>
            @endforeach
        </div>
        @error('technologies')
            <div class="text-danger">{{ $message }}</div>
        @enderror

        {{-- date input --}}
        <div class="mb-3">
            <label for="date" class="form-label ">Sale Date</label>
            <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror"
                placeholder="add the date" value="{{ old('date') }}" />
            @error('date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Description input --}}
        <div class="mb-3">
            <label for="description" class="form-label ">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                rows="5" placeholder="add the description">{{ old('description') }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            Submit
        </button>
        <a class="btn btn-primary" href="{{ route('admin.projects.index') }}">Back</a>

    </form>
@endsection
