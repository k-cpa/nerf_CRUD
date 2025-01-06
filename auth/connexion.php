<?php
    include_once("../include/environnement.php");

    if (isset($_POST['name']) && (isset($_POST['password']))) {
        if (!empty($_POST['name']) && (!empty($_POST['password']))) {
            $username = htmlspecialchars(trim(strtolower($_POST['name'])));
            $password = htmlspecialchars(trim($_POST['password']));
            
            $request = $bdd->prepare('
                SELECT *
                FROM admin
                WHERE username = ?
            ');
            $request->execute([$username]);

            while ($userData = $request->fetch()) {
                if (password_verify($password, $userData['password'])) {
                    $_SESSION['admin'] = $userData['admin_id'];

                    header ('location: ../index.php');
                    exit();
                } else {
                    header ('location: connexion.php?errorconnect=1'); // mot de passe est faux
                }
            }
        } else {
            header ('location: connexion.php?errorconnect=2'); // Erreur champ vide
        }
    }
?>

<?php include ("../include/head.php"); ?>
<body>
    <?php include ("../include/nav.php"); ?>
    <section id="connect">
        <h3>Connexion <span>administrateur</span></h3>
        <div class="connect_container">
            <form action="connexion.php" method="post">
                <input type="text" id="name" name="name" placeholder="Nom d'utilisateur" required>
                <input type="password" id="password" name="password" placeholder="Mot de passe" required>
                <button type="submit">Valider</button>
                <?php 
                    if (isset($_GET['errorconnect'])) {
                        $error = $_GET['errorconnect'];
                        switch($error) {
                            case 1 :
                                echo "<p class='error'>Le mot de passe saisi est incorrect</p>";
                                break;
                            case 2 :
                                echo "<p class='error'>Veuillez remplir tous les champs</p>";
                                break;
                        }
                    }
                ?>
            </form>
        </div>
    </section>
</body>