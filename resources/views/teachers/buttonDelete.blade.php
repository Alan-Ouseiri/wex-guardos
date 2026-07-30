<a href="{{ route('teachers.edit', $user) }}" class="me-2 text-decoration-none">
    <i class="fa-solid fa-pencil"></i>
</a>

<button type="button" class="btn btn-link text-danger p-0 align-baseline" data-bs-toggle="modal"
    data-bs-target="#deleteTeacherModal{{ $user }}">
    <i class="fa-regular fa-trash-can text-danger"></i>
</button>