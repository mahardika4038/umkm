<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= isset($title) ? $title : 'Login Sistem UMKM' ?></title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f6f9; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0;">

<div style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); width: 100%; max-width: 350px; box-sizing: border-box;">
    <h2 style="text-align: center; margin-bottom: 20px; color: #333;">Mulai Sesi UMKM</h2>
    
    <?php if (session()->getFlashdata('error')): ?>
        <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-bottom: 15px; font-size: 14px; text-align: center;">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <form action="/login/proses" method="post">
        <?= csrf_field(); ?>
        
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Username</label>
            <input type="text" name="username" required placeholder="Masukkan username" autocomplete="off" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
        </div>
        
        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Password</label>
            <input type="password" name="password" required placeholder="Masukkan password" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
        </div>
        
        <button type="submit" style="width: 100%; padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">Masuk Aplikasi 🚪</button>
    </form>
</div>

</body>
</html>