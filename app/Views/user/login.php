<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="<?= base_url('/style.css'); ?>">
</head>
<body>

<div id="login-wrapper">
    <h2>Login</h2>

    <?php if(session()->getFlashdata('flash_msg')): ?>
        <p style="color:red"><?= session()->getFlashdata('flash_msg') ?></p>
    <?php endif; ?>

    <form method="post">
        <p>Email:</p>
        <input type="email" name="email">

        <p>Password:</p>
        <input type="password" name="password">

        <br><br>
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>