<h3>Daftar Buku</h3>
<form method="get">
    <input type="text" name="q" value="<?= esc($search) ?>" placeholder="Cari...">
    <button type="submit">Cari</button>
</form>
<table border="1" cellpadding="5">
<tr><th>Judul</th><th>Penulis</th><th>Penerbit</th><th>Tahun</th><th>Aksi</th></tr>
<?php foreach ($buku as $b): ?>
<tr>
    <td><?= esc($b['judul']) ?></td>
    <td><?= esc($b['penulis']) ?></td>
    <td><?= esc($b['penerbit']) ?></td>
    <td><?= esc($b['tahun_terbit']) ?></td>
    <td>
        <a href="/buku/edit/<?= $b['id'] ?>">Edit</a> |
        <a href="/buku/delete/<?= $b['id'] ?>" onclick="return confirm('Yakin?')">Hapus</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
<?= $pager->links() ?>
