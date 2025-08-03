<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-3xl font-bold mb-4"><?= esc($buku->judul) ?></h1>
        <div class="text-gray-700 mb-4">
            <p><strong>Penulis:</strong> <?= esc($buku->penulis) ?></p>
            <p><strong>Penerbit:</strong> <?= esc($buku->penerbit) ?></p>
            <p><strong>Tahun Terbit:</strong> <?= esc($buku->tahun_terbit) ?></p>
            <p><strong>ISBN:</strong> <?= esc($buku->isbn) ?></p>
        </div>
        <div class="prose max-w-none mb-6">
            <h2 class="text-2xl font-bold mb-2">Deskripsi</h2>
            <p><?= esc($buku->deskripsi) ?></p>
        </div>
        <?php if (!empty($buku->file_buku)): ?>
            <a href="<?= base_url($buku->file_buku) ?>" target="_blank" class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Buka Buku
            </a>
        <?php else: ?>
            <p class="text-red-500">Maaf, file buku tidak tersedia.</p>
        <?php endif; ?>
        <a href="<?= base_url('buku') ?>" class="inline-block mt-4 text-blue-500 hover:text-blue-700">Kembali ke Daftar Buku</a>
    </div>
</div>
