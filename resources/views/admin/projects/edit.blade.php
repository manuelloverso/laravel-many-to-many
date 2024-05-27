@extends('layouts.admin')

@section('content')
    <h1>Edit {{ $project->title }}</h1>
    @include('partials.validate-errors')

    <form action="{{ route('admin.projects.update', $project) }}" method="post" enctype="multipart/form-data">
        @csrf {{-- this is a laravel directive to protect your application from cross-site request forgery --}}
        @method('PUT')
        {{-- title input --}}
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                placeholder="add the title" value="{{ old('title', $project->title) }}" />
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- image input --}}
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" id="image" class="form-control  @error('image') is-invalid @enderror"
                placeholder="add the image" value="{{ old('image', $project->image) }}" />
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
                    <option class="text-uppercase" value="{{ $type->id }}"
                        {{ $type->id == old('type_id', $project->type_id) ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- technologies input --}}
        <div class="mb-3">
            <label for="technologies" class="form-label ">technologies</label>
            <input type="text" name="technologies" id="technologies"
                class="form-control @error('technologies') is-invalid @enderror" placeholder="add the used technologies"
                value="{{ old('technologies', $project->technologies) }}" />
            @error('technologies')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- date input --}}
        <div class="mb-3">
            <label for="date" class="form-label ">Sale Date</label>
            <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror"
                placeholder="add the sale date" value="{{ old('date', $project->date) }}" />
            @error('date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Description input --}}
        <div class="mb-3">
            <label for="description" class="form-label ">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                rows="5" placeholder="add the description">{{ old('description', $project->description) }}</textarea>
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
