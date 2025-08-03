<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Tambah Buku Baru</h2>
    <?php if (session()->getFlashdata('errors')): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Error!</strong>
            <ul class="mt-2 list-disc list-inside">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?php echo esc($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php echo form_open_multipart(base_url('buku/simpan'), ['class' => 'bg-white shadow-md rounded-lg p-6']); ?>
        <div class="mb-4">
            <label for="judul" class="block text-gray-700 text-sm font-bold mb-2">Judul Buku:</label>
            <input type="text" name="judul" id="judul" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo old('judul'); ?>" required>
        </div>
        <div class="mb-4">
            <label for="penulis" class="block text-gray-700 text-sm font-bold mb-2">Penulis:</label>
            <input type="text" name="penulis" id="penulis" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo old('penulis'); ?>" required>
        </div>
        <div class="mb-4">
            <label for="penerbit" class="block text-gray-700 text-sm font-bold mb-2">Penerbit:</label>
            <input type="text" name="penerbit" id="penerbit" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo old('penerbit'); ?>">
        </div>
        <div class="mb-4">
            <label for="tahun_terbit" class="block text-gray-700 text-sm font-bold mb-2">Tahun Terbit:</label>
            <input type="number" name="tahun_terbit" id="tahun_terbit" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo old('tahun_terbit'); ?>">
        </div>
        <div class="mb-4">
            <label for="isbn" class="block text-gray-700 text-sm font-bold mb-2">ISBN:</label>
            <input type="text" name="isbn" id="isbn" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo old('isbn'); ?>">
        </div>
        <div class="mb-4">
            <label for="deskripsi" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi:</label>
            <textarea name="deskripsi" id="deskripsi" rows="5" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"><?php echo old('deskripsi'); ?></textarea>
        </div>
        <div class="mb-6">
            <label for="file_buku" class="block text-gray-700 text-sm font-bold mb-2">File Buku (PDF/ePub):</label>
            <input type="file" name="file_buku" id="file_buku" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" required>
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Simpan Buku
            </button>
            <a href="<?= base_url('buku') ?>" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                Kembali
            </a>
        </div>
    </form>
</div>
