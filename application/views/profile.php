<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
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
                    <li><a href="<?php echo site_url('auth/dashboard'); ?>">Dashboard</a></li>
                    <li><a href="<?php echo site_url('auth/profile'); ?>">Profile</a></li>
                    <li><a href="<?php echo site_url('auth/search'); ?>">Search</a></li>
                    <li><a href="<?php echo site_url('auth/logout'); ?>">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <h2>Profile</h2>
        <?php if ($user->profile_picture): ?>
            <div class="form-group">
                <img src="<?php echo base_url('uploads/' . $user->profile_picture); ?>" alt="Profile Picture">
            </div>
        <?php endif; ?>
        <?php echo form_open_multipart('auth/update_profile'); ?>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" value="<?php echo set_value('name', $user->name); ?>">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?php echo set_value('email', $user->email); ?>">
            </div>
            <div class="form-group">
                <label for="password">New Password (leave blank if not changing):</label>
                <input type="password" name="password" id="password">
            </div>
            <div class="form-group">
                <label for="profile_picture">Change Profile Picture:</label>
                <input type="file" name="profile_picture" id="profile_picture">
            </div>
            <button type="submit" class="btn">Update Profile</button>
        <?php echo form_close(); ?>
    </div>

    <footer>
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> Registration Portal by "TUSHAR TOMAR". All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
