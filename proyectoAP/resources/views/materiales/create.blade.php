<form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" required>

    <label for="foto">Foto:</label>
    <input type="file" name="foto" accept="image/*" required>

    <button type="submit">Guardar</button>
</form>
