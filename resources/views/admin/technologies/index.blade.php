@extends('layouts.admin')

@section('content')
    <div class=" mb-3 d-flex justify-content-between">
        <h3>Available Technologies</h3>
        <a class="btn btn-primary" href="{{ route('admin.technologies.create') }}">Add Technology</a>
    </div>
    @include('partials.action-message')
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
                @forelse ($technologies as $technology)
                    <tr class="">
                        <td scope="row"><strong>{{ $technology->id }}</strong></td>
                        <td>{{ $technology->name }}</td>


                        <td>
                            {{-- NOT SHOWING THE SINGLE TYPE AS THERE IS NOTHING TO SHOW --}}
                            <a class="btn btn-dark" href="{{ route('admin.technologies.edit', $technology) }}"><i
                                    class="fa-solid fa-pencil "></i></a>
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
