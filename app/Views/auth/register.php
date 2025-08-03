<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        
        .bg-register {
            background-image: url('<?= base_url('images/image_login1.png') ?>');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
    </style>
</head>
<body class="bg-register font-sans antialiased relative flex items-center justify-center min-h-screen p-4">
    
    <div class="absolute inset-0 bg-black opacity-60"></div>
    
    <div class="relative z-10 bg-white/80 backdrop-blur-sm p-8 rounded-2xl shadow-xl w-full max-w-sm border border-gray-200">
        <h2 class="text-3xl font-extrabold text-center text-gray-800 mb-6 drop-shadow-sm">Daftar Akun</h2>

        <?php if (session()->getFlashdata('errors')) : ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-4" role="alert">
                <ul class="list-disc list-inside">
                    <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <form action="<?= base_url('register/process') ?>" method="post">

            <div class="mb-4">
                <label for="username" class="block text-gray-700 text-sm font-semibold mb-2">Username</label>
                <input type="text" name="username" id="username" class="shadow-sm appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" value="<?= old('username') ?>">
            </div>
            
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-semibold mb-2">Email</label>
                <input type="email" name="email" id="email" class="shadow-sm appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" value="<?= old('email') ?>">
            </div>
            
            <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">Password</label>
                <input type="password" name="password" id="password" class="shadow-sm appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
            </div>
            
            <div class="mb-6">
                <label for="confirm_password" class="block text-gray-700 text-sm font-semibold mb-2">Konfirmasi Password</label>
                <input type="password" name="confirm_password" id="confirm_password" class="shadow-sm appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
            </div>
            
            <div class="flex flex-col items-center justify-between space-y-4">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg focus:outline-none focus:shadow-outline transform transition duration-300 hover:scale-105">
                    Daftar
                </button>
                <a href="<?= base_url('login') ?>" class="inline-block align-baseline font-bold text-sm text-blue-600 hover:text-blue-800 transition duration-200">
                    Sudah punya akun? Masuk
                </a>
            </div>
        </form>
    </div>
</body>
</html>
