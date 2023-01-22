<?php
    $path ="../php/classes.php";

    require_once $path;

    $link = "../database/Emargement.db";
    
    $DSNSqlite = "sqlite:$link";

    $pdo = new Personnes($DSNSqlite);

    if (isset($_POST["Verifier"]) && !empty($_POST)){
        $P = $pdo->PDOVerification();
        $responses = $pdo->Verification($_POST);
       
        if ($responses == TRUE){
            $verifier = "Conforme";
        }else {
            $verifier = "NConforme";
        }

        header("location: ../index.php?Verifier={$verifier}");
    }

    if (isset($_POST["Valider"]) && !empty($_POST)){
        $request = $pdo->InsertData($_POST);
        if ($request == FALSE){
            header("location: ../index.php");
        }else {
            $valider = "NValide";
            header("location: Liste.php");
        }
    }


?>