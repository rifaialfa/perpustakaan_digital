<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="<?= base_url('images/icon1.png'); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .bg-dashboard {
            background-image: url('<?= base_url('images/image_dashboard.png') ?>');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        
        .pagination li a,
        .pagination li span {
            display: block;
            padding: 0.5rem 1rem;
            border: 1px solid #e2e8f0;
            margin: 0 0.25rem;
            border-radius: 0.375rem;
            transition: all 0.2s ease-in-out;
        }
        .pagination li a:hover {
            background-color: #f7fafc;
        }
        .pagination li.active a,
        .pagination li.active span {
            background-color: #4c51bf;
            color: white;
            border-color: #4c51bf;
            cursor: default;
        }
        .pagination li.disabled a,
        .pagination li.disabled span {
            color: #a0aec0;
            cursor: not-allowed;
            background-color: #edf2f7;
        }
    </style>
</head>
<body class="bg-gray-100">

    
    <header class="bg-blue-600 shadow-md">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                
                <div class="flex-shrink-0">
                    <a href="<?= base_url() ?>" class="text-white text-xl font-bold">Perpustakaan Digital</a>
                </div>

                
                <nav class="hidden md:block">
                    <ul class="flex items-center space-x-4">
                        <?php if (session()->get('isLoggedIn')): ?>
                            <li class="flex items-center space-x-2">
                                <span class="text-white text-sm font-medium">Selamat Datang,</span>
                                <span class="text-white font-bold">
                                    <?php
                                    
                                    echo esc(session()->get('username'));
                                    ?>
                                </span>
                                <?php if (session()->get('role') === 'admin'): ?>
                                    <span class="bg-blue-800 text-white text-xs font-semibold px-2 py-1 rounded-full">Admin</span>
                                <?php else: ?>
                                    <span class="bg-gray-400 text-gray-800 text-xs font-semibold px-2 py-1 rounded-full">User</span>
                                <?php endif; ?>
                            </li>
                            <li><a href="<?= base_url('logout') ?>" class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-md font-medium transition-colors">Logout</a></li>
                        <?php else: ?>
                            <li><a href="<?= base_url('login') ?>" class="bg-white text-blue-600 hover:bg-blue-100 px-3 py-2 rounded-md font-medium transition-colors">Login</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>

                
                <div class="md:hidden">
                    <button id="mobile-menu-button" type="button" class="text-white hover:text-blue-200">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        
        <div id="mobile-menu" class="hidden md:hidden bg-blue-700">
            <ul class="px-2 pt-2 pb-3 space-y-1">
                <?php if (session()->get('isLoggedIn')): ?>
                    <li class="py-2 px-3">
                        <p class="text-white font-medium">
                            Selamat Datang, <span class="font-bold"><?= esc(session()->get('username')) ?></span>
                        </p>
                        <p class="mt-1">
                            <?php if (session()->get('role') === 'admin'): ?>
                                <span class="bg-blue-800 text-white text-xs font-semibold px-2 py-1 rounded-full">Admin</span>
                            <?php else: ?>
                                <span class="bg-gray-400 text-gray-800 text-xs font-semibold px-2 py-1 rounded-full">User</span>
                            <?php endif; ?>
                        </p>
                    </li>
                    <li><a href="<?= base_url('logout') ?>" class="block bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-md font-medium transition-colors">Logout</a></li>
                <?php else: ?>
                    <li><a href="<?= base_url('login') ?>" class="block text-white hover:bg-blue-500 hover:text-white px-3 py-2 rounded-md font-medium transition-colors">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </header>

    <script>
        
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
