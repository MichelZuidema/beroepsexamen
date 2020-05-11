<header>
    <div class="container">
        <div id="branding">
            <h1>EK 2020 Voorspellen</h1>
        </div>
        <nav>
            <ul>
                <li><a href="#">Thuis</a></li>
                <?php if(isset($_SESSION['user_id'])) : ?>
                <li><a href="assets/db/logout.php">Logout</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>