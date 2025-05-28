<form action="{{ route('pengembalian.ajukan', $item->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="bukti_pengembalian">Ambil Foto Pengembalian:</label>
    <input type="file" name="bukti_pengembalian" accept="image/*" capture="environment" class="form-control" required>

    <img id="preview" style="max-width: 100%; margin-top: 10px;" alt="Preview">

    <button type="submit" class="btn btn-primary mt-2">Ajukan Pengembalian</button>
</form>

<script>
document.querySelector('input[name="bukti_pengembalian"]').addEventListener('change', function (e) {
    const file = e.target.files[0];
    if (file) {
        document.getElementById('preview').src = URL.createObjectURL(file);
    }
});
</script>
