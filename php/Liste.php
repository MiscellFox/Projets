<?php
    
    $path ="../php/classes.php";

    require_once $path;

    $link = "../database/Emargement.db";

    $DSNSqlite = "sqlite:$link";

    $pdo = new Personnes($DSNSqlite);

    $P = $pdo->PDOVerification();

    $request = $pdo->getData($P);
    sort($request);
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/Liste.css">
        <title>Document</title>

    </head>

    <body>
        <header>
            <div class="logo">
                <img src="../Image/AWS-Cloud-1.png" alt="logo" class="image">
                <a href="#">Amazon Service Cloud</a>
            </div>
            <a class="signin-button" href="../index.php">
                <!-- <iconify-icon icon="material-symbols:home-outline-rounded"></iconify-icon> -->
                Home
            </a>
        </header>
        <main>
            <div class="liste-participants">
                <h2>Liste d'emargements</h2>
                <table>
                    <tr>
                        <th>Numero</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Telephone</th>
                        <th>Email</th>
                    </tr>
                    <?php 
                        $array = [];
                    ?>
                    <?php for($i = 0; $i < count($request); $i++) : ?>
                    <?php 
                            $array =  $request[$i];
                        ?>
                    <tr>
                        <td>
                            <?= $i + 1 ?>
                        </td>
                        <?php foreach ($array as $data) : ?>
                        <td>
                            <?= $data ?>
                        </td>
                        <?php endforeach ?>
                    </tr>
                    <?php endfor?>
                </table>
            </div>
        </main>
    </body>
</html>