<?php 
    include ("include/environnement.php");

    $request = $bdd->prepare ('
        SELECT
            gun_id,
            gun_name,
            gun_image,
            gun_cadence,
            description
        FROM
            guns
    ');
    $request->execute([])
?>

<?php
    $title = "Nerf";
    include ("include/head.php"); 
?>
<body>
    <?php include ("include/nav.php") ?>
    <section id="banner">
        <div class="banner_title">
            <h2>Déclenche l'adrénaline avec les blasters Nerf ! Des jeux d’action excitants pour tous les niveaux et toutes les aventures.</h2>
        </div>
    </section>
    <section id="guns">
            <div class="section_gun_title">
                <h3>Notre gamme <span>nerf</span></h3>
            </div>
<!-- GESTION MESSAGES SUCCESS -->

            <?php
            if (isset($_GET['success'])) {
                $success = $_GET['success'];
                switch($success) {
                    case 1 : 
                        echo "<p class='success'>Votre jouet à bien été ajouté </p>";
                        break;
                    case 2 : 
                        echo "<p class='success'>Votre jouet à bien été modifié </p>";
                        break;
                    case 3 : 
                        echo "<p class='success'>Votre jouet à bien été supprimé </p>";
                        break;
                }
            }
        ?>
        <div class="container_guns">

        
            <?php while ($data = $request->fetch()) : ?>
                <article class="gun_card">
                    <div class="img_wrapper">
                        <?php if($data['gun_image'] == NULL): ?>
                            <img src="assets/img/no_image.jpg" alt="Image temporaire indiquant qu'aucun visuel n'est disponible pour ce pistolet nerf">
                        <?php else: ?>
                            <img src="assets/img/nerf-img/<?= $data['gun_image']; ?>" alt="Image du pistolet nerf <?= $data['gun_name'] ?>">
                        <?php endif ?>
                    </div>
                    <div class="gun_elements">
                        <div class="gun_title">
                            <h4><?= $data['gun_name']; ?></h4>
                        </div>
                        <div class="gun_content">
                            <p><?= $data['description']; ?></p>
                            <p><?= $data['gun_cadence']; ?> tirs par seconde</p>
                        </div>
                    </div>

                    <?php if(isset($_SESSION['admin'])): ?>
                        <div class="action">
                            <a href="<?= 'action/edit.php?id=' . $data['gun_id']; ?>">Modifier</a>
                            <a href="<?= 'action/delete.php?id=' . $data['gun_id']; ?>">Supprimer</a>
                        </div>
                    <?php endif ?>
                </article>
            <?php endwhile ?>
        </div>
    </section>

</body>
<?php include ("include/footer.php") ?>
</html>