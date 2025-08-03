<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        
        .bg-login {
            background-image: url('<?= base_url('images/image_login1.png') ?>');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
    </style>
</head>
<body class="bg-login font-sans antialiased relative flex items-center justify-center min-h-screen p-4">
    
    <div class="absolute inset-0 bg-black opacity-60"></div>
    
    
    <div class="relative z-10 bg-white/80 backdrop-blur-sm p-8 rounded-2xl shadow-xl w-full max-w-sm border border-gray-200">
        <h2 class="text-3xl font-extrabold text-center text-gray-800 mb-6 drop-shadow-sm">Masuk Akun</h2>

        
        <?php if (session()->getFlashdata('errors')) : ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-4" role="alert">
                <ul class="list-disc list-inside">
                    <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-4" role="alert">
                <?= esc(session()->getFlashdata('success')) ?>
            </div>
        <?php endif; ?>

        
        <form action="<?= base_url('login/process') ?>" method="post">
            
            <div class="mb-4">
                <label for="username_or_email" class="block text-gray-700 text-sm font-semibold mb-2">Username atau Email</label>
                <input type="text" name="username_or_email" id="username_or_email" class="shadow-sm appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" value="<?= old('username_or_email') ?>">
            </div>
            
            <div class="mb-6">
                <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">Password</label>
                <input type="password" name="password" id="password" class="shadow-sm appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
            </div>
            
            <div class="flex flex-col items-center justify-between space-y-4">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg focus:outline-none focus:shadow-outline transform transition duration-300 hover:scale-105">
                    Masuk
                </button>
                <a href="<?= base_url('register') ?>" class="inline-block align-baseline font-bold text-sm text-blue-600 hover:text-blue-800 transition duration-200">
                    Belum punya akun? Daftar
                </a>
            </div>
        </form>
    </div>
</body>
</html>
