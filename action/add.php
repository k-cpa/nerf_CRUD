<?php 
    include ("../include/environnement.php");

    // if (!isset($_SESSION['admin_id'])) {
    //     header ('location: ../index.php');
    //     exit;
    // }

    if (isset($_POST['gun_name']) && isset($_POST['description']) && isset($_POST['gun_cadence'])) {
        $gun_name = htmlspecialchars($_POST['gun_name']);
        $description = htmlspecialchars($_POST['description']);
        $gun_cadence = htmlspecialchars($_POST['gun_cadence']);
    
    if (isset($_FILES['image'])) {
        // NOM DU FICHIER IMAGE
        $image = $_FILES['image']['name'];
        $imageTmp = $_FILES['image']['tmp_name']; // NOM TEMPORAIRE DU FICHIER IMAGE
        $infoImage = pathinfo($image); //TABLEAU QUI DECORTIQUE LE NOM DE FICHIER
        $extImage = $infoImage['extension']; //EXTENSION 
        $imageName = $infoImage['filename']; //NOM DU FICHIER SANS L'EXTENSION
        //GENERATION D'UN NOM DE FICHIER UNIQUE
        $uniqueName = $imageName . time() . rand(1, 1000) . "." . $extImage;

        move_uploaded_file($imageTmp, '../assets/img/nerf-img/' . $uniqueName);
    }

    $request = $bdd->prepare ('
        INSERT INTO guns (gun_name, description, gun_cadence, gun_image, admin_id)
        VALUES (?,?,?,?,?)
    ');
    $request->execute([
        $gun_name,
        $description,
        $gun_cadence,
        $uniqueName,
        $_SESSION['admin']
    ]);
    header ('location: ../index.php?success=1');


    }

?>

<?php
    $title = "Ajouter un jouet";
    include_once('../include/head.php') 
?>
<body>
    
</body>
</html>
<body>
    <?php include_once("../include/nav.php") ?>
    <section class="add">
        <div class="add_title">
            <h3>Ajouter un nouveau <span>nerf</span></h3>
        </div>
        <article class="add_container">
            <form action="add.php#add" method="post" enctype="multipart/form-data">
                <input type="text" id="gun_name" name="gun_name" placeholder="Nom du jouet" required>
                <input type="number" step="0.01" min="0" id="gun_cadence" name="gun_cadence" placeholder="Cadence de tir du jouet" required>
                <textarea id="description" name="description" placeholder="brève description du pistolet nerf" required></textarea>
                <input type="file" id="image" name="image">
                <button type="submit">Ajouter</button>
            </form>
        </article>
    </section>
</body>
    
