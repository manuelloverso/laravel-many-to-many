@if (session('message'))
    <div class=" alert alert-{{ str_contains(session('message'), 'deleted') ? 'danger' : 'success' }}  ">
        {{ session('message') }}
    </div>
@endif
