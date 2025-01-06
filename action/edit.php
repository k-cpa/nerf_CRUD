<?php
    include ("../include/environnement.php");

    $id = $_GET['id'];

    $request = $bdd->prepare ('
        SELECT * 
        FROM guns 
        WHERE gun_id = ?
    ');
    $request->execute([$id]);

    $values = $request->fetchAll();

    foreach ($values as $value) :
        if ($_SESSION['admin'] == TRUE) {
            if (isset($_POST['name']) && (isset($_POST['description'])) && (isset($_POST['gun_cadence']))) {
                $gun_name = isset($_POST['name']);
                $description = $_POST['description'];
                $gun_cadence = $_POST['gun_cadence'];

                $requestModif = $bdd->prepare ('
                    UPDATE guns
                    SET gun_name = :name, description = :description, gun_cadence= :gun_cadence
                    WHERE gun_id = :id
                ');
                $requestModif->execute([
                    'gun_name' => $gun_name,
                    'description' => $description,
                    'gun_cadence' => $gun_cadence,
                    'gun_id' => $id
                ]);
                header ('location: ../index.php?success=2');
            } 
        } else {
            header ('location: ../index.php');
        }
    endforeach;
?>

<?php
    $title = "Modification du jouet";
    include("../include/head.php"); 
?>

<body>
    <?php
    include_once('../include/nav.php');
    ?>
    <section class="add">
        <h3>Modification du jouet <span>nerf</span></h3>
        <article class="add_container">
            <!--Formulaire de modification-->
            <form action="edit.php<?= '?id=' . $id ?>" method="POST">

                <!--ON FAIT UN FOREACH PLUTOT QU'UN WHILE CAR LES DONNEES SONT RECUPEREES EN FETCHALL()-->
                <?php foreach ($values as $value) : ?>
                    <label for="name">Modifier le nom :</label>
                    <input type="text" id="name" name="name" value="<?= $value['gun_name'] ?>">

                    <label for="description">Modifier la description :</label>
                    <textarea name="description" id="description" cols=" 30" rows="10"><?= $value['description'] ?></textarea>
                <?php endforeach; ?>
                <button>Modifier</button>
            </form>
        </article>
    </section>
</body>
</html>