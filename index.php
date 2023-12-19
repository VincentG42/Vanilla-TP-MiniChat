<?php
require_once('./process/database-connect.php');
//requete lecture messages join users pour affichage chat
$request = $database->query("SELECT * FROM users");

$pseudoList = $request->fetchAll();

//requete lecture users pour affichage liste user

$request = $database->query("SELECT * FROM `messages` JOIN users ON messages.user_id = users.id ORDER BY messages.id DESC
                                LIMIT 10");

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
            rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
            crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <header class="container-fluid g-0 darkblue-bg">
        <div class="row">
            <h1 class = "text-center mt-4">Mini-Chat </h1>
            <h3 class = "text-end fs-6 pe-5">By Vincent</h3>
        </div>
    </header>

    <main class="container mt-5">
        <div class="row topChat justify-content-between mb-5 px-3">
            <div class="chatWindow col-9 card-bgcolor">
                <?php foreach ($messages as $message) { ?>
                        <div class="row my-2 position-relative">
                            <div class="col-3">
                                <div class="ms-5  pseudo"><?php echo $message["pseudo"] ?> </div>
                                <div class="dateTime"><?php echo $message["created_at"] ?> </div>
                            </div>
                            <div class="col-8 content"><?php echo $message["content"] ?> </div>
                    </div>

                <?php } ?>
            </div>

            <div class="userList col-2 card-bgcolor text-center">
                <?php foreach ($pseudoList as $pseudo) {
                    echo '<p class="pseudo">' . $pseudo["pseudo"] . '</p>';
                } ?>
            </div>
        </div>

        <div class="newMessage card-bgcolor"><!-- form message -->
        <form id="message_form" class="row align-items-center">
            <!-- action="./process/newMessage-to-db.php"  -->

                <div class="col-3 m-2">
                    <label for="fname">Pseudo: </label><br>
                    <input type="text" id="pseudo" name="pseudo" class="card-bgcolor" value="<?php echo $_COOKIE['pseudo'] ?>">
                </div>

                <div class="col-7 m-2">
                    <label for="content">Message:</label><br>
                    <input class="col-12 card-bgcolor" type="textarea" id="content" name="content"></input>
                </div>


                <input type="hidden" name="dateTime"  id="dateTime" value="<?php echo $requestTime ?>">
                <input type="hidden" name="ip_adress" id="ip_adress" value="<?php echo $ipUSer ?>">

                <button  id="submit" class="col-1 mt-1 rounded-1 darkblue-bg">Envoyer</button>
            </form>
        </div>

    </main>

    <footer></footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" 
    crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="./js/main.js"></script>

</body>

</html>