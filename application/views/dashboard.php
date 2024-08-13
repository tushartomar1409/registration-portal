<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body>
    <header>
        <div class="container">
            <div id="branding">
            <h3>Registration Portal by "TUSHAR TOMAR"</h3>
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

    <div class="dashboard">
        <?php if ($profile_picture): ?>
            <img src="<?php echo base_url('uploads/' . $profile_picture); ?>" alt="Profile Picture" width="150">
        <?php endif; ?>
        <h1>Welcome, <?php echo $name; ?>!</h1>
        <!-- <ul>
            <li><a href="<?php echo site_url('auth/profile'); ?>">Profile</a></li>
            <li><a href="<?php echo site_url('auth/search'); ?>">Search</a></li>
            <li><a href="<?php echo site_url('auth/logout'); ?>">Logout</a></li>
        </ul> -->
    </div>
</body>
</html>
