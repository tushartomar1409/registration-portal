<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body>
    <header>
        <div class="container">
            <div id="branding">
                <h2>Registration Portal by "TUSHAR TOMAR"</h2>
            </div>
            <nav>
                <ul>
                    <?php if ($this->session->userdata('logged_in')): ?>
                        <li><a href="<?php echo site_url('auth/dashboard'); ?>">Dashboard</a></li>
                        <li><a href="<?php echo site_url('auth/profile'); ?>">Profile</a></li>
                        <li><a href="<?php echo site_url('auth/search'); ?>">Search</a></li>
                        <li><a href="<?php echo site_url('auth/logout'); ?>">Logout</a></li>
                    <?php else: ?>
                        <li><a href="<?php echo site_url('auth/login'); ?>">Login</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <div class="form-container">
        <h2>Register</h2>
        <?php echo form_open_multipart($form_action); ?>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" value="<?php echo set_value('name'); ?>">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?php echo set_value('email'); ?>">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password">
            </div>
            <div class="form-group">
                <label for="profile_picture">Profile Picture:</label>
                <input type="file" name="profile_picture" id="profile_picture">
            </div>
            <button type="submit" class="btn">Register</button>
        <?php echo form_close(); ?>
    </div>

    <footer>
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> Registration Portal by "TUSHAR TOMAR". All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
