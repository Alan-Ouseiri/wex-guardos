<div class="d-flex justify-content-around">
    <a href="{{ route('devices.edit', $device) }}" class="text-decoration-none">
        <i class="fa-solid fa-pencil"></i>
    </a>

    <button type="button" class="btn btn-link text-danger p-0" data-bs-toggle="modal"
        data-bs-target="#deleteDeviceModal{{ $device }}">
        <i class="fa-regular fa-trash-can text-danger"></i>
    </button>
</div>