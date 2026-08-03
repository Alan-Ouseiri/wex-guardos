<div class="d-flex justify-content-around">
    <!-- Eliminar -->
    <form method="POST" action="{{ route('responsivas.forceDelete', $r) }}"
        onsubmit="return confirm('¿Eliminar definitivamente?')">
        @csrf
        @method('DELETE')
        <button class="text-danger" style="background: none; border: none;">
            <i class="fa-solid fa-trash-can" data-bs-toggle="tooltip" data-bs-placement="top"
                title="Eliminar Responsiva"></i>
        </button>
    </form>
    <!-- Restaurar -->
    <form action="{{ route('responsivas.restore', $r) }}" method="POST" class="d-inline">
        @csrf
        <button class="text-success" style="background: none; border: none;" type="submit"
            onclick="return confirm('¿Deseas restaurar esta responsiva?')">
            <i class="fa-solid fa-rotate-left"></i>
        </button>
    </form>
</div>