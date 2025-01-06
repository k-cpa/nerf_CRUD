<?php 
    include ('../include/environnement.php');

    $id = htmlspecialchars($_GET['id']);

    $requestSelect = $bdd->prepare ('
        SELECT * 
        FROM guns
        WHERE gun_id = ?
    ');
    $requestSelect->execute([$id]);

    while ($data = $requestSelect->fetch()) {
        if (isset($_SESSION['admin'])) {
            $request = $bdd->prepare ('
                DELETE FROM guns
                WHERE gun_id = ?
            ');
            $request->execute([$id]);
            header ('location: ../index.php?success=3');
            exit();
        } else {
            header ('location : index.php');
            exit();
        }
    }
