<header>
    <div class="container">
        <div id="branding">
            <h1>EK 2020 Voorspellen</h1>
        </div>
        <nav>
            <ul>
                <?php if(isset($_SESSION['user_id'])) : ?>
                <li><a href="home.php">Poules</a></li>
                <li><a href="assets/db/logout.php">Logout</a></li>
                <?php else : ?>
                <li><a href="index.php">Thuis</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>