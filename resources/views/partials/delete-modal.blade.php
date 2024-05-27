<!-- Modal trigger button -->
<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalId-{{ $project->id }}">
    <i class="fa-solid fa-trash"></i>
</button>
<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<div class="modal fade text-dark" id="modalId-{{ $project->id }}" tabindex="-1" data-bs-backdrop="static"
    data-bs-keyboard="false" role="dialog" aria-labelledby="#modalTitleId-{{ $project->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId-{{ $project->id }}">
                    Deleting '{{ $project->title }}'
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Are you sure you want to delete this project? The action will
                be permanent</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <form action="{{ route('admin.projects.destroy', $project) }}" method="post">
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
