<?php

require_once('./database-connect.php');

// var_dump($_POST);

if(isset($_POST['pseudo']) && !empty($_POST['pseudo'])
&& isset($_POST['content']) && !empty($_POST['content'])){
    
    $pseudo = $_POST['pseudo'];
    $content = $_POST['content'];
    $ip = $_POST['ip_adress'];
    $dateTime = $_POST['dateTime'];

    // var_dump($pseudo);
    
    //requete existance pseudo (if count=1 pseudo existant, else pseudo a creer)
    $request = $database->query("SELECT * FROM users where pseudo ='$pseudo'");

    $pseudoExists = $request->fetch();
    // var_dump("pseudo exist");
    // var_dump($pseudoExists);



    
    if ($pseudoExists){
        $request = $database->query("SELECT id FROM users where pseudo = '$pseudo'");
        
        $pseudoID = $request->fetch();
        var_dump('hello');
        var_dump($pseudoID["id"]);

        $requete = $database->prepare("INSERT INTO messages (content, created_at, ip_adress, user_id) 
                                        VALUES (:content,:created_at,:ip_adress,:user_id)");

            $result = $requete->execute(['content' => $content, 
                                        'created_at' => $dateTime, 
                                        'ip_adress' => $ip, 
                                        'user_id' => $pseudoID["id"]]);
    } else{
        //    var_dump('hello');
        $requete = $database->prepare("INSERT INTO users (pseudo)
                                        VALUES (:pseudo)");

        $result = $requete->execute([
        'pseudo' => $pseudo
        ]);

        $idLastUSer = $database->lastInsertId();
        var_dump($idLastUSer);

        $requete = $database->prepare("INSERT INTO messages (content, created_at, ip_adress, user_id) 
        VALUES (:content,:created_at,:ip_adress,:user_id)");

        $result = $requete->execute(['content' => $content, 
                                    'created_at' => $dateTime, 
                                    'ip_adress' => $ip, 
                                    'user_id' =>$idLastUSer]);

    }

}

header('Location: ../index.php');
?>
