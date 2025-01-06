<header>

    <nav>
        <div class="logo_wrapper">
            <a href="index.php"><img src="/nerf/assets/img/logo_nerf.png" alt="Logo de la marque nerf"></a>
        </div>
        <ul>
            <li><a href="#guns">Notre gamme</a></li>
            <?php if (isset($_SESSION['admin'])): ?>
                <li><a href="action/add.php">Ajouter un jouet</a></li>
                <li><a href="auth/deconnexion.php">Déconnexion</a></li>
            <?php endif ?>
        </ul>
    </nav>
</header>