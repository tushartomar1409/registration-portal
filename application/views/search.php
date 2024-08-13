<!DOCTYPE html>
<html>
<head>
    <title>Search</title>
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

    <div class="container">
        <h2>Search</h2>
        <?php echo form_open('auth/search_results'); ?>
            <input type="text" class="custom-form-control" name="query" placeholder="Search for images or videos" required>
            <button type="submit" class="btn">Search</button>
        <?php echo form_close(); ?>

        <?php if (isset($results)): ?>
            <div class="results-grid">
                <?php foreach ($results as $result): ?>
                    <div class="result-item">
                        <img src="<?php echo $result['webformatURL']; ?>" alt="<?php echo $result['tags']; ?>">
                        <p><?php echo $result['tags']; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php elseif (isset($error)): ?>
            <p><?php echo $error; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
