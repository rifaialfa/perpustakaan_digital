    <div class="bg-dashboard h-52 flex justify-center items-center text-black">
        <h1 class="text-4xl font-bold">Daftar Buku</h1>
    </div>

    <div class="container mx-auto p-4 md:p-8 -mt-24">
        
        <div class="flex justify-between items-center mb-6">
            <form action="<?= base_url('buku') ?>" method="get" class="flex-grow max-w-lg">
                <div class="flex items-center border border-gray-300 rounded-full bg-white shadow-sm">
                    <input type="text" name="q" value="<?= esc($searchQuery) ?>" placeholder="Cari buku..." class="w-full px-4 py-2 rounded-full focus:outline-none">
                    <button type="submit" class="p-2 text-gray-600">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>
                </div>
            </form>
            <?php if (session()->get('role') === 'admin'): ?>
                <a href="<?= base_url('buku/tambah') ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full transition duration-300 ease-in-out transform hover:scale-105">
                    Tambah Buku
                </a>
            <?php endif; ?>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline"><?= session()->getFlashdata('success') ?></span>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline"><?= session()->getFlashdata('error') ?></span>
            </div>
        <?php endif; ?>

        <?php if (!empty($buku)): ?>
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Judul
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Penulis
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Penerbit
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Tahun Terbit
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($buku as $item): ?>
                                <tr>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <div class="flex items-center">
                                            <div class="ml-3">
                                                <p class="text-gray-900 whitespace-no-wrap"><?= esc($item->judul) ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap"><?= esc($item->penulis) ?></p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap"><?= esc($item->penerbit) ?></p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap"><?= esc($item->tahun_terbit) ?></p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right">
                                        <div class="flex items-center space-x-2">
                                            <a href="<?= base_url($item->file_buku) ?>" target="_blank" class="text-indigo-600 hover:text-indigo-900 transition-colors">Lihat File</a>
                                            <?php if ($userRole === 'admin'): ?>
                                                <a href="<?= base_url('buku/edit/' . $item->id) ?>" class="text-yellow-600 hover:text-yellow-800 transition-colors">Edit</a>
                                                <button type="button" onclick="showDeleteModal('<?= base_url('buku/hapus/' . $item->id) ?>')" class="text-red-600 hover:text-red-800 transition-colors">Hapus</button>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="mt-6 flex justify-center">
                <nav class="pagination" role="navigation" aria-label="Pagination Navigation">
                    <ul class="flex list-style-none">
                        <?php if ($currentPage > 1): ?>
                            <li><a href="<?= base_url('buku?q=' . esc($searchQuery) . '&page=' . ($currentPage - 1)) ?>" class="rounded-l-lg">&laquo; Sebelumnya</a></li>
                        <?php else: ?>
                            <li class="disabled"><span class="rounded-l-lg">&laquo; Sebelumnya</span></li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="<?= ($i == $currentPage) ? 'active' : '' ?>">
                                <a href="<?= base_url('buku?q=' . esc($searchQuery) . '&page=' . $i) ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                        
                        <?php if ($currentPage < $totalPages): ?>
                            <li><a href="<?= base_url('buku?q=' . esc($searchQuery) . '&page=' . ($currentPage + 1)) ?>" class="rounded-r-lg">Selanjutnya &raquo;</a></li>
                        <?php else: ?>
                            <li class="disabled"><span class="rounded-r-lg">Selanjutnya &raquo;</span></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        <?php else: ?>
            <div class="bg-white shadow-md rounded-lg p-6 mt-6">
                <p class="text-gray-700 text-center">Tidak ada buku yang ditemukan.</p>
            </div>
        <?php endif; ?>
    </div>
    
    
    <div id="deleteModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                                Konfirmasi Hapus
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Apakah Anda yakin ingin menghapus buku ini? Tindakan ini tidak dapat dibatalkan.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <a id="confirmDeleteButton" href="#" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Hapus
                    </a>
                    <button type="button" onclick="hideDeleteModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        
        const deleteModal = document.getElementById('deleteModal');
        const confirmDeleteButton = document.getElementById('confirmDeleteButton');

        function showDeleteModal(url) {
            confirmDeleteButton.href = url;
            deleteModal.classList.remove('hidden');
        }

        function hideDeleteModal() {
            deleteModal.classList.add('hidden');
        }
    </script>
