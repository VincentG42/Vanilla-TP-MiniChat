<?php
require_once('./process/database-connect.php');
//requete lecture messages join users pour affichage chat
$request = $database->query("SELECT * FROM users");

$pseudoList = $request->fetchAll();

//requete lecture users pour affichage liste user

$request = $database->query("SELECT * FROM `messages` JOIN users ON messages.user_id = users.id ORDER BY messages.created_at ");

$messages = $request->fetchAll();



$requestTime = date('Y-m-d h:i:s', $_SERVER['REQUEST_TIME']);

$ipUSer = $_SERVER['SERVER_ADDR'];


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>

    </header>

    <main>
        <div class="chatWindow">

        <?php foreach($messages as $message){ ?>
            <div><?php echo $message["pseudo"] ?> </div>

                <div><?php echo $message["created_at"] ?> </div>
                <div><?php echo $message["content"] ?> </div>
                
                
                <?php } ?>


        </div>
        <div class="userList">
            <?php foreach($pseudoList as $pseudo){
                echo '<p>'.$pseudo["pseudo"].'</p>';}?>
        </div>
        <div class="newMessage"><!-- form message -->
            <form action="./process/newMessage-to-db.php" method="post">

                <label for="fname">Pseudo: </label><br>
                <input class="" type="text" id="pseudo" name="pseudo">

                <label for="content">Message: :</label><br>
                <textarea  class=""type="textarea" id="content" name="content"></textarea>

                
                <input type="hidden" name="dateTime" value="<?php echo $requestTime?>">
                <input type="hidden" name="ip_adress" value="<?php echo $ipUSer?>">

                <button type="submit">Envoyer</button>
            </form>
        </div>

    </main>

    <footer></footer>

</body>
</html>