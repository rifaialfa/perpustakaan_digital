<h3>Edit Buku</h3>
<form method="post">
    Judul: <input name="judul" value="<?= esc($buku['judul']) ?>"><br>
    Penulis: <input name="penulis" value="<?= esc($buku['penulis']) ?>"><br>
    Penerbit: <input name="penerbit" value="<?= esc($buku['penerbit']) ?>"><br>
    Tahun Terbit: <input type="number" name="tahun_terbit" value="<?= esc($buku['tahun_terbit']) ?>"><br>
    <button type="submit">Update</button>
</form>
